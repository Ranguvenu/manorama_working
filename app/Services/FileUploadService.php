<?php
namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile as SymfonyUploadedFile;

class FileUploadService
{
    public $is_protected;

    public $base_directory;

    public $disc;

    public function __construct($component = '', $protected = false, $disc = '')
    {
        $this->is_protected = $protected;
        $this->base_directory = $this->create_directory_hierarchy($component);
        $this->disc = $disc ? $disc : env('STORAGE_DISC');
    }

    public function upload_from_url($url)
    {
        try {
            $contents = file_get_contents($url);
            if ($contents === false) {
                return false;
            }
            $temp = tempnam(sys_get_temp_dir(), 'temp');
            file_put_contents($temp, $contents);
            $file = UploadedFile::createFromBase(new SymfonyUploadedFile($temp, basename($url)));

            return $this->upload($file);
        } catch (Exception $e) {
            return false;
        }
    }

    public function upload($file)
    {
        try {
            $filename = $this->get_file_name($file->getClientOriginalName());
            $url = $this->store_file($file, $filename);

            return [
                'url' => $this->get_full_url($url),
                'extension' => $file->extension(),
                'size' => $file->getSize(),
                'name' => $url,
                'type' => $file->getMimeType(),
                'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            ];
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete($file)
    {
        return $this->delete_file($file);
    }

    public function create_directory_hierarchy($component)
    {
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $hierarchy = ['uploads', 'media', $year, $month, $component];
        $path = implode('/', $hierarchy);
        if (!$this->directory_exists($path)) {
            Storage::makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

    protected function get_file_name($name)
    {
        $increment = 1;
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $filename = pathinfo($name, PATHINFO_FILENAME);
        while ($this->file_exists($name)) {
            $name = $filename.'('.$increment.').'.$extension;
            ++$increment;
        }

        return $name;
    }

    protected function store_file($file, $filename)
    {
        if ($this->disc == 's3') {
            $url = Storage::disk($this->disc)->putFileAs($this->base_directory, new File($file), $filename);
        } else {
            $url = Storage::disk($this->disc)->putFileAs($this->base_directory, new File($file), $filename, 'public');
        }

        return $url;
    }

    protected function delete_file($file)
    {
        // return $file;
        if (Storage::disk($this->disc)->exists($file)) {
            return Storage::disk($this->disc)->delete($file);
        }

        return false;
    }

    protected function directory_exists($directory)
    {
        return in_array($directory, Storage::disk($this->disc)->directories()) ? true : false;

        return Storage::disk($this->disc)->directoryExists($directory) ? true : false;
    }

    protected function file_exists($filename)
    {
        return Storage::disk($this->disc)->fileExists($this->base_directory.'/'.$filename) ? true : false;
    }

    protected function get_full_url($url)
    {
        return ($this->disc == 's3') ? Storage::disk('s3')->url($url) : asset('storage/'.$url);
    }
}

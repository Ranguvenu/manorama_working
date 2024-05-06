<?php

namespace App\Traits;

trait TemplatesTrait
{
    public function get_content($args)
    {
        $content = $this->content;
        $placeholders = array_combine_unequal($this->notification_type->variables, $args);
        foreach ($placeholders as $key => $value) {
            $content = str_replace($key, $value, $content);
        }

        return $content;
    }
}

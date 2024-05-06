<?php

namespace App\Http\Requests\SiteSettings;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [];
        $rules['category'] = 'required';
        if ($this->has('category') && $this->get('category') == 'lms_sso_settings') {
            $rules['configuration.lms_token'] = 'required';
            $rules['configuration.lms_url'] = 'required';
            $rules['configuration.lms_encryption_key'] = 'required';
        } elseif ($this->has('category') && $this->get('category') == 'sms_settings') {
            $rules['configuration.send_sms_via'] = 'required';
            $rules['configuration.sinch_plan_id'] = 'required';
            $rules['configuration.sinch_api_token'] = 'required';
            $rules['configuration.sinch_from_number'] = 'required';
            $rules['configuration.sms_country_auth_key'] = 'required';
            $rules['configuration.sms_country_auth_token'] = 'required';
            $rules['configuration.sms_country_sender_id'] = 'required';
        } elseif ($this->has('category') && $this->get('category') == 'email_smtp_settings') {
            $rules['configuration.email_smtp_host'] = 'required';
            $rules['configuration.email_smtp_port'] = 'required';
            $rules['configuration.email_smtp_encryption'] = 'required';
            $rules['configuration.email_smtp_username'] = 'required';
            $rules['configuration.email_smtp_password'] = 'required';
            $rules['configuration.email_smtp_from_mail'] = 'required';
            $rules['configuration.email_smtp_from_name'] = 'required';
        } elseif ($this->has('category') && $this->get('category') == 'paymentgateway_settings') {
            $rules['configuration.paymentgateway'] = 'required';
            $rules['configuration.payment_razorpay_key_id'] = 'required';
            $rules['configuration.payment_razorpay_key_secret'] = 'required';
        } elseif ($this->has('category') && $this->get('category') == 'theme_footer') {
            $rules['configuration.footer_links.*.name'] = 'required';
            $rules['configuration.footer_links.*.children.*.name'] = 'required';
            $rules['configuration.footer_links.*.children.*.link'] = 'required';
        } elseif ($this->has('category') && $this->get('category') == 'theme_settings') {
            $rules['configuration.theme_ga_code'] = 'required';
            $rules['configuration.theme_facebook'] = 'required';
            $rules['configuration.theme_instagram'] = 'required';
            $rules['configuration.theme_youtube'] = 'required';
            $rules['configuration.theme_linkedin'] = 'required';
            $rules['configuration.theme_pininterest'] = 'required';
            $rules['configuration.theme_secondaryfooter_content'] = 'required';
            $rules['configuration.theme_contactemail'] = 'required|email';
            $rules['configuration.theme_contactphone'] = 'required';
            $rules['configuration.theme_websitelogo'] = 'required';
            $rules['configuration.theme_mobilelogo'] = 'required';
        } elseif ($this->has('category') && $this->get('category') == 'menu_settings') {
            $rules['configuration.menu.*.title'] = 'required';
            $rules['configuration.menu.*.url'] = 'required';
            $rules['configuration.menu.*.categories.*.title'] = 'required';
            $rules['configuration.menu.*.categories.*.url'] = 'required';
            $rules['configuration.menu.*.categories.*.items.*.title'] = 'required';
            $rules['configuration.menu.*.categories.*.items.*.url'] = 'required';
        } elseif ($this->has('category') && $this->get('category') == 'blog_sidebar') {
            $rules['configuration.sidebar.*.title'] = 'required';
            $rules['configuration.sidebar.*.layout'] = 'required';
            $rules['configuration.sidebar.*.more.label'] = 'nullable';
            $rules['configuration.sidebar.*.more.link'] = 'nullable';
            $rules['configuration.sidebar.*.limit'] = 'required|gt:0';
            $rules['configuration.sidebar.*.value'] = 'required|gt:0';
            $rules['configuration.sidebar.*.type'] = 'required';
        } elseif ($this->has('category') && $this->get('category') == 'links') {
            $rules['configuration.home'] = 'required';
            $rules['configuration.articles'] = 'required';
            $rules['configuration.currentaffairs'] = 'required';
            $rules['configuration.studymaterials'] = 'required';
            $rules['configuration.webinars'] = 'required';
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        if($this->has('category') && $this->get('category') == 'menu_settings'){
            $messages['configuration.menu.*.title.required'] = 'Menu title is required' ; 
            $messages['configuration.menu.*.url.required'] = 'Menu URL is required' ; 
            $messages['configuration.menu.*.categories.*.title'] = 'Category title is required';
            $messages['configuration.menu.*.categories.*.url'] = 'Category URL is required';
            $messages['configuration.menu.*.categories.*.items.*.title'] = 'Item title is required';
            $messages['configuration.menu.*.categories.*.items.*.url'] = 'Item url is required';
        } elseif ($this->has('category') && $this->get('category') == 'theme_footer') {
            $messages['configuration.footer_links.*.name.required'] = 'Heading is required';
            $messages['configuration.footer_links.*.children.*.name.required'] = 'Label is required';
            $messages['configuration.footer_links.*.children.*.link.required'] = 'URL is required';
        } elseif ($this->has('category') && $this->get('category') == 'blog_sidebar') {
            $messages['configuration.sidebar.*.title.required'] = 'Title is required';
            $messages['configuration.sidebar.*.layout.required'] = 'Layout is required';
            $messages['configuration.sidebar.*.limit.required'] = 'Limit is required';
            $messages['configuration.sidebar.*.value.required'] = 'Goal is required';
            $messages['configuration.sidebar.*.limit.gt'] = 'Limit is required';
            $messages['configuration.sidebar.*.value.gt'] = 'Goal is required';
        } elseif ($this->has('category') && $this->get('category') == 'links') {
            $messages['configuration.home.required'] = 'Home is required field';
            $messages['configuration.articles.required'] = 'Articles is required field';
            $messages['configuration.currentaffairs.required'] = 'Current Affairs is required field';
            $messages['configuration.studymaterials.required'] = 'Study Materials is required field';
            $messages['configuration.webinars.required'] = 'Webinars is required field';
        }

        return $messages;
    }
}

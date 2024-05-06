<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import MediaButton from "@/Components/MediaButton.vue";
import ButtonOutline from "@/Components/ButtonOutline.vue";
import SuccessIcon from "@/SvgIcons/SuccessIcon.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";

const props = defineProps({
    can_edit: {
        type: Boolean,
        required: true
    },
    job: {
        type: Object,
        required: true
    },
    application: {
        type: Object,
        required: false
    },
    submitted: {
        type: Boolean,
        default: false
    }
});

const get_assignments = () => {
    let assignments = [];
    props.job.assignments.forEach((value, index) => {
        assignments.push({
            'assignment_id': value.id,
            'url': props.can_edit ? get_assignment_url(value.id) : ''
        })
    });
    return assignments;
};

const get_assignment_url = (id) => {
    if(props.application && props.application.assignments && props.application.assignments.length > 0){
        let index = props.application.assignments.findIndex(x => x.assignment_id == id);
        if(index > -1){
            let assignment = props.application.assignments[index];
            return assignment['url'];
        }
    }
    return ''
};

const form = useForm({
    job_id: props.job.id,
    slug: props.job.slug,
    title: props.job.title,
    status: 1,
    subject: props.job.subject,
    qualification: (props.can_edit && props.application) ? props.application.qualification : '',
    resume: (props.can_edit && props.application) ? props.application.resume : '',
    assignments: get_assignments()
});

const submit = (status) => {
    let url = (props.application && props.application.id) ? route("careers.application.update", {job: props.job.slug, application: props.application.id}) : route("careers.job.store", {job: props.job.slug});
    form.status = status; 
    form.post(url, {
        onSuccess: () => {
        },
    });
};
</script>
<template>
    <section>
          <div v-if="submitted">
            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                <div class="max-w-5xl custom_md:max-w-4xl mx-auto flex bg-emerald-50 rounded-[7px] border border-green-600 items-center justify-between py-6 px-6 absolute top-[65px] left-0 right-0" v-if="form.recentlySuccessful">
                    <div class="mr-4"><img src="/images/correct.png" alt="Submitted" /></div>
                    <div class="text-zinc-800 flex flex-col flex-grow">
                        <div class="text-base font-semibold">Submitted</div>
                        <div class="text-[15px]">Thank you for your interest in working with us. We will get back to you within 3 weeks if we find your profile is suitable.</div>
                    </div>
                </div>
            </Transition>
        </div>
        <form class="mt-6 space-y-8" v-if="!submitted">
            <Transition enter-active-class="transition ease-in-out" enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out" leave-to-class="opacity-0">
                <div class="max-w-5xl custom_md:max-w-4xl mx-auto flex bg-emerald-50 rounded-[7px] border border-green-600 items-center justify-between py-6 px-6 absolute top-[65px] left-0 right-0" v-if="form.recentlySuccessful">
                    <div class="mr-4"><img src="/images/correct.png" alt="Submitted" /></div>
                    <div class="text-zinc-800 flex flex-col flex-grow">
                        <div class="text-base font-semibold">Success</div>
                        <div class="text-[15px]">Your application has saved successfully</div>
                    </div>
                </div>
            </Transition>
            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-12 border border-stone-300 rounded-md py-3 px-6">
                <div class="mt-1 col-span-12">
                    <div class="font-semibold text-xl text-gray-800 mb-3">
                        1. Basic Details and Resume Upload
                    </div>
                    <div class="border-b border-gray-200"></div>
                </div>
                <div class="mt-3 md:col-span-4 custom_md:col-span-6 col-span-12">
                    <InputLabel for="role" value="Role Applying for" />
                    <TextInput type="text" class="mt-1 block w-full text-zinc-800 text-[15px] bg-neutral-100 rounded-[5px] border border-stone-300" v-model="form.title" autofocus
                        disabled autocomplete="role" />
                    <InputError class="mt-2" v-if="form && form.errors"
                        :message="form.errors.title" />
                </div>
                <div class="mt-3 md:col-span-4 custom_md:col-span-6 col-span-12">
                    <InputLabel for="subject" value="Subject" />
                    <TextInput type="text" class="mt-1 block w-full text-zinc-800 text-[15px] bg-neutral-100 rounded-[5px] border border-stone-300" v-model="form.subject"
                        disabled autofocus autocomplete="form.subject" />
                    <InputError class="mt-2" v-if="form && form.errors"
                        :message="form.errors.subject" />
                </div>
                <div class="mt-3 md:col-span-4 custom_md:col-span-6 col-span-12">
                    <InputLabel for="qualification" value="Highest Educational Qualification" />
                    <TextInput type="text" class="mt-1 block w-full text-zinc-800 text-[15px]" v-model="form.qualification"
                        autofocus autocomplete="form.qualification" />
                    <InputError class="mt-2" v-if="form && form.errors.qualification" :message="form.errors.qualification"/>
                </div>
                <div class="mt-3 mb-3 md:col-span-4 custom_md:col-span-6 col-span-12">
                    <InputLabel class="mb-1" for="resume">Upload Resume <span class="text-red-600">*</span></InputLabel>
                    <MediaButton accepts="pdf,doc,docx" component="careers" name="Upload" :multiple="false" return_type="url"
                        v-model="form.resume" />
                    <div class="text-zinc-800 text-[15px] my-3" v-if="form.resume"><a class="text-primary" :href="form.resume" download>Download</a></div>
                    <div class="text-gray-600 text-xs">Note: Resume should be in .pdf, .doc or .docx format. Size of the file should not exceed 1MB</div>
                    <InputError class="mt-2" v-if="form && form.errors" :message="form.errors.resume" />
                </div>
            </div>
            <div class="border border-stone-300 rounded-md py-3 px-6" v-if="job.assignments && job.assignments.length">
                <div class="mt-1 col-span-12">
                    <div class="font-semibold text-xl text-gray-800 mb-3">
                        2. Assignment
                    </div>
                    <div class="border-b border-gray-200"></div>
                </div>
                <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-12 pb-6" v-for="(task, index) in job.assignments">
                    <input type="hidden" v-model="form.assignments[index].assignment_id"/>
                    <div class="sm:col-span-12 mt-4">
                        <div class="text-zinc-800 text-base font-semibold py-1">Task 1 : {{ task.title }}</div>
                        <div class="text-gray-800">
                            <div v-html="task.description"></div>
                        </div>
                    </div>
                    <div class="mt-3 md:col-span-4 custom_md:col-span-6 col-span-12">
                        <InputLabel for="video_link">{{ task.meta.link_button_label }} <span class="text-red-600">*</span></InputLabel>
                        <TextInput type="text" class="mt-1 block w-full text-zinc-800 text-[15px]" v-model="form.assignments[index].url" autofocus
                            autocomplete="form.video_link" />
                            <div class="text-gray-600 text-xs">{{ task.meta.link_button_help }}</div>
                        <InputError class="mt-2" v-if="form && form.errors" :message="form.errors[$get_error_key('assignments', 'url', index)]" />
                    </div>
                    <div class="sm:col-span-12">
                        <div class="text-black text-xs">OR</div>
                    </div>
                    <div class="md:col-span-4 custom_md:col-span-6 col-span-12">
                        <InputLabel class="mb-1" for="task">{{ task.meta.upload_button_label }} <span class="text-red-600">*</span></InputLabel>
                        <MediaButton accepts="pdf,doc,docx" component="jobapplications" :name="task.meta.upload_button_label" :multiple="false" return_type="url"
                            v-model="form.assignments[index].url" />
                            <div class="text-gray-600 text-xs">Note: Document should be in .pdf format.</div>
                        <InputError class="mt-2" v-if="form && form.errors" :message="form.errors[$get_error_key('assignments', 'url', index)]" />
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <ButtonOutline :disabled="form.processing" v-on:click="submit(1)">Save</ButtonOutline>
                <PrimaryButton :disabled="form.processing" v-on:click="submit(2)">Submit</PrimaryButton>
            </div>
        </form>
    </section>
</template>

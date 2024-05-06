<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

import { Link, useForm, usePage } from "@inertiajs/vue3";

const props = defineProps({
    data: {
        type: Object,
        default: null,
    },
    edit: {
        type: Boolean,
    },
    taxonomy: {
        type: String,
    },
});

const form = useForm({
    id: props.edit ? props.data.id : "",
    name: props.edit ? props.data.name : "",
    taxonomy: props.taxonomy 
});

const submit = () => {
    if (props.edit) {
        form.put(route("masterdata.categories.update", props.data.id), {
            onFinish: () => {
                form.name = null;
            },
        });
    } else {
        form.post(route("masterdata.categories.store"), {
            onFinish: () => {
                (form.name = null), (form.code = null);
            },
        });
    }
};
</script>
<template>
    <section>
        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <div>
                    <InputLabel for="name" value="Name" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
        
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p
                        v-if="form.recentlySuccessful"
                        class="text-sm text-gray-600"
                    >
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </section>
</template>

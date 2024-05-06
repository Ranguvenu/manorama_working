<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";

import { Link, useForm, usePage } from "@inertiajs/vue3";

const props = defineProps({
    data: {
        type: Object,
        default: null,
    },
    edit: {
        type: Boolean,
    },
    permissions: {
        type: Object,
        default: null,
    }
});
const form = useForm({
    id: props.edit ? props.data.id : "",
    name: props.edit ? props.data.name : "",
    permissions: [],
});

const selectedOptions = props.edit ? props.data.permissions:[];
const final = [];
selectedOptions.forEach(element => {
    final.push(element.id);
});
const isChecked = (index) => {
    if(final.includes(index)){
        return 1;
    }
    else{
        return 0
    }
};

const submit = () => {
    if (props.edit) {
        form.put(route("usermanagement.roles.update", props.data.id), {
            onFinish: () => {
                form.name = null,
                form.permissions = null,
                form.selectedOptions = null
            }
        });
    } else {
        form.post(route("usermanagement.roles.store"), {
            onFinish: () => {
                form.name = null,
                form.permissions = null,
                form.selectedOptions = null
            }
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

                <div
                    v-for="(permission, index) in props.permissions"
                    :key="index"
                    class="mt-3"
                >
                    <label class="flex items-center">
                        <Checkbox
                            name="permissions"
                            :value="permission.name"
                            v-model:checked=form.permissions
                            :checked=isChecked(permission.id)
                        />
                        <span class="ml-2 text-sm text-gray-600">{{
                            permission.name
                        }}</span>
                    </label>
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

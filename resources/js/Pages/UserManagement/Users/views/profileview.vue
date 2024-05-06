<script setup>
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    staff: {
        type: Object
    }
});
</script>

<template>
    <Head title="Staff Details" />
    <div class="container">
        <ul>
            <ol><span>Address 1 </span> </ol>
        </ul>
    </div>
</template>
<template>
    <div class="w-full max-w-3xxl text-sm">
        <table class="min-w-full bg-white border-0">
            <tr>
                <td class="w-1/3 text-left py-4 px-8 text-dark font-medium">Firstname</td>
                <td class="w-2/3 text-left py-4 px-4 text-dark ">{{ data.firstname }}</td>
            </tr>
            <tr>
                <td class="w-1/3 text-left py-4 px-8 text-dark font-medium">Lastname</td>
                <td class="w-2/3 text-left py-4 px-4 text-dark ">{{ data.lastname }}</td>
            </tr>
            <tr>
                <td class="w-1/3 text-left py-4 px-8 text-dark font-medium">Contact Number</td>
                <td class="w-2/3 text-left py-4 px-4 text-dark ">{{ data.phone }}</td>
            </tr>
            <tr>
                <td class="w-1/3 text-left py-4 px-8 text-dark font-medium">Contact Email</td>
                <td class="w-2/3 text-left py-4 px-4 text-dark ">{{ data.email }}</td>
            </tr>
            <tr>
                <td class="w-1/3 text-left py-4 px-8 text-dark font-medium">Date of Birth</td>
                <td class="w-2/3 text-left py-4 px-4 text-dark ">{{ data.dob }}</td>
            </tr>
            <tr>
                <td class="w-1/3 text-left py-4 px-8 text-dark font-medium">Address</td>
                <td class="w-2/3 text-left py-4 px-4 text-dark ">
                    <div>{{ data.address }}</div>
                    <div>{{ data.address2 }}</div>
                </td>
            </tr>
            <!--
            <tr>
                <td class="w-1/3 text-left py-4 px-8 text-dark font-medium">City</td>
                <td class="w-2/3 text-left py-4 px-4 text-dark ">{{ data.city }}</td>
            </tr>-->
            <tr>
                <td class="w-1/3 text-left py-4 px-8 text-dark font-medium">State</td>
                <td class="w-2/3 text-left py-4 px-4 text-dark">{{ data.state_name }}</td>
            </tr>
            <tr>
                <td class="w-1/3 text-left py-4 px-8 text-dark font-medium">Country</td>
                <td class="w-2/3 text-left py-4 px-4 text-dark">{{ data.country_name }}</td>
            </tr>
            <tr>
                <td class="w-1/3 text-left py-4 px-8 text-dark font-medium">Member Since</td>
                <td class="w-2/3 text-left py-4 px-4 text-dark ">{{ data.created_at }}</td>
            </tr>
            <tr>
                <td class="w-1/3 text-left py-4 px-8 text-dark font-medium">Last Updated On</td>
                <td class="w-2/3 text-left py-4 px-4 text-dark ">{{ data.updated_at }}</td>
            </tr>
        </table>
    </div>
</template>
<script>

export default {
    props: {
        data: {
            type: Object,
            required: true
        }
    },
    components: {

    },
    data() {
        return {

        }
    },
    methods: {

    },
    mounted() {

    }
}
</script>

<template>
    <div class="m-6">
        <div class="font-semibold text-gray-800 mb-3">Hierarchy</div>
        <div class="grid grid-cols-12 gap-x-6 gap-y-8 sm:grid-cols-12">
            <div class="col-span-6">
                <InputLabel for="packagetype" class="mb-1">Package Type<span class="text-red-400">*</span></InputLabel>
                <select class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md w-full" v-model="form.package_type" :disabled="edit">
                    <option v-for="(packagetype, index) in data.package_types" :key="index" :value="index">{{ packagetype }}</option>
                </select>
                <InputError class="mt-2" v-if="errors && errors.package_type" :message="errors.package_type[0]"/>
            </div>
            <div class="col-span-6">
                <InputLabel for="goal_id" class="mb-1">Goal <span class="text-red-400">*</span></InputLabel>
                <MultiSelect v-model="form.goal_id" returns="id" :options="data.goals" label="title" :multiple="false" :disabled="edit"/>
                <InputError class="mt-2" v-if="errors && errors.goal_id" :message="errors.goal_id[0]"/>
            </div>
            <div class="col-span-6">
                <InputLabel for="Board" class="mb-1">Board <span class="text-red-400">*</span></InputLabel>
                <MultiSelect v-model="form.board_id" returns="id" :options="data.boards" label="title" :multiple="false" :disabled="edit"/>
                <InputError class="mt-2" v-if="errors && errors.board_id" :message="errors.board_id[0]"/>
            </div>
            <div class="col-span-6">
                <InputLabel for="Class" class="mb-1">Class <span class="text-red-400">*</span></InputLabel>
                <MultiSelect v-model="form.class_id" returns="id" :options="data.classes" label="title" :multiple="false" :disabled="edit"/>
                <InputError class="mt-2" v-if="errors && errors.class_id" :message="errors.class_id[0]"/>
            </div>
            <div class="col-span-6" v-if="form.package_type == 0">
                <InputLabel for="Subjects" class="mb-1">Subjects <span class="text-red-400">*</span></InputLabel>
                <MultiSelect v-model="form.subjects" returns="id" :options="data.subjects" label="title" :multiple="true" :disabled="edit"/>
                <InputError class="mt-2" v-if="errors && errors.subjects" :message="errors.subjects[0]"/>
            </div>
            <div class="col-span-12">
                <InputLabel for="thumbnail">Image Upload <span class="text-red-400">*</span></InputLabel>
                <MediaButton class="mt-2" accepts="png,jpeg,svg,jpg" component="ecommerce" name="Select Image" :multiple="false" return_type="id" v-model="form.thumbnail_id"/>
                <InputError class="mt-2" v-if="errors && errors.thumbnail_id" :message="errors.thumbnail_id[0]"/>
            </div>
        </div>
        <div class="font-semibold text-gray-800 mb-3">Package Details</div>
        <div class="grid grid-cols-12 gap-x-6 gap-y-8 sm:grid-cols-12">
            <div class="col-span-6">
                <InputLabel for="title">Title <span class="text-red-400">*</span></InputLabel>
                <TextInput type="text" class="mt-1 block w-full" v-model="form.title" placeholder="Title"/>
                <InputError class="mt-2" v-if="errors && errors.title" :message="errors.title[0]"/>
            </div>
            <div class="col-span-6">
                <InputLabel for="title">Code <span class="text-red-400">*</span></InputLabel>
                <TextInput type="text" class="mt-1 block w-full" v-model="form.code" placeholder="Code"/>
                <InputError class="mt-2" v-if="errors && errors.code" :message="errors.code[0]"/>
            </div>
            <div class="col-span-12">
                <InputLabel for="description">Description <span class="text-red-400">*</span></InputLabel>
                <CkEditor v-model="form.description" />
                <InputError class="mt-2" v-if="errors && errors.description" :message="errors.description[0]"/>
            </div>
            <div class="col-span-6">
                <InputLabel for="Validity Type" class="mb-1">Validity Type <span class="text-red-400">*</span></InputLabel>
                <select v-model="form.validity_type" class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md w-full">
                    <option value="days">In Days</option>
                    <option value="date">On Date</option>
                </select>
                <InputError class="mt-2" v-if="errors && errors.validity_type" :message="errors.validity_type[0]"/>
            </div>
            <div class="col-span-6">
                <div v-if="form.validity_type == 'days'">
                    <InputLabel for="days" class="mb-1">Duration in Days<span class="text-red-400">*</span></InputLabel>
                    <TextInput type="text" class="mt-1 block w-full" v-model="form.valid_for" placeholder="Duration in Days"
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                </div>
                <div v-if="form.validity_type == 'date'">
                    <InputLabel for="validuntil" class="mb-1">Expiry Date<span class="text-red-400">*</span></InputLabel>
                    <TextInput type="date" class="mt-1 block w-full" v-model="form.valid_for"/>
                </div>
                <InputError class="mt-2" v-if="errors && errors.valid_for" :message="errors.valid_for[0]"/>
            </div>
            <div class="col-span-6">
                <InputLabel for="validfrom" class="mb-1">Valid From<span class="text-red-400">*</span></InputLabel>
                <TextInput type="date" class="mt-1 block w-full" v-model="form.valid_from"/>
                <InputError class="mt-2" v-if="errors && errors.valid_from" :message="errors.valid_from[0]"/>
            </div>
            <div class="col-span-6">
                <InputLabel for="validfrom" class="mb-1">Valid To<span class="text-red-400">*</span></InputLabel>
                <TextInput type="date" class="mt-1 block w-full" v-model="form.valid_to"/>
                <InputError class="mt-2" v-if="errors && errors.valid_to" :message="errors.valid_to[0]"/>
            </div>
            <div class="col-span-6">
                <InputLabel for="startdate" class="mb-1">Enrollment Start Date<span class="text-red-400">*</span></InputLabel>
                <TextInput type="date" class="mt-1 block w-full" v-model="form.enrollment_start_date" />
                <InputError class="mt-2" v-if="errors && errors.enrollment_start_date" :message="errors.enrollment_start_date[0]"/>
            </div>
            <div class="col-span-6">
                <InputLabel for="enddate" class="mb-1">Enrollment End Date<span class="text-red-400">*</span></InputLabel>
                <TextInput type="date" class="mt-1 block w-full" v-model="form.enrollment_end_date"/>
                <InputError class="mt-2" v-if="errors && errors.enrollment_end_date" :message="errors.enrollment_end_date[0]"/>
            </div>
            <div class="col-span-3" v-if="edit">
                <InputLabel for="paymenttype" class="mb-1">Status<span class="text-red-400">*</span></InputLabel>
                <select class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md w-full" v-model="form.is_published">
                    <option value="1">Published</option>
                    <option value="0">Unpublished</option>
                    <option value="2">Archived</option>
                </select>
                <InputError class="mt-2" v-if="errors && errors.is_paid" :message="errors.is_paid[0]"/>
            </div>
            <div class="col-span-3">
                <InputLabel for="paymenttype" class="mb-1">Payment Type<span class="text-red-400">*</span></InputLabel>
                <select class="border-gray-300 focus:border-gray-400 focus:ring-gray-400 rounded-md w-full" v-model="form.is_paid" :disabled="edit">
                    <option v-for="(paymenttype, index) in data.payment_types" :key="index"  :value="index">{{ paymenttype }}</option>
                </select>
                <InputError class="mt-2" v-if="errors && errors.is_paid" :message="errors.is_paid[0]"/>
            </div>
            <div class="col-span-3" v-if="form.is_paid">
                <InputLabel for="paymenttype" class="mb-1">Trial Duration (In Days)<span class="text-red-400">*</span></InputLabel>
                <TextInput type="text" class="mt-1 block w-full" v-model="form.is_trial_available" placeholder="Duration in Days" 
                onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                <InputError class="mt-2" v-if="errors && errors.is_trial_available" :message="errors.is_trial_available[0]"/>
            </div>
            
            <div class="col-span-3" v-if="form.is_paid">
                <InputLabel for="paymenttype" class="mb-1">External Agency Course<span class="text-red-400">*</span></InputLabel>
                <Checkbox  v-model="form.is_external_course" placeholder="Title" :checked="form.is_external_course"/>
                <InputError class="mt-2" v-if="errors && errors.is_external_course" :message="errors.is_external_course[0]"/>
            </div>
            <div class="col-span-12" v-if="form.is_external_course">
                <InputLabel for="description">Instructions To Enroll <span class="text-red-400">*</span></InputLabel>
                <CkEditor v-model="form.instructions" />
                <InputError class="mt-2" v-if="errors && errors.instructions" :message="errors.instructions[0]"/>
            </div>
        </div>
        <div class="my-4 float-right">
            <ButtonRegular size="sm" color="primary" v-if="!edit" v-on:click="store(true)">Save and Continue</ButtonRegular>
            <ButtonRegular size="sm" color="primary" v-if="!edit" v-on:click="store(false)">Save Draft</ButtonRegular>
            <ButtonRegular size="sm" color="primary" v-if="edit" v-on:click="update(form.id)">Update</ButtonRegular>
            <ButtonRegular size="sm" color="default" v-on:click="close_modal">Close</ButtonRegular>
        </div>
    </div>
</template>
<script>
    import ButtonRegular from "@/Components/Button.vue";
    import SideModal from '@/Components/SideModal.vue';
    import MultiSelect from '@/Components/MultiSelect.vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import TextInput from '@/Components/TextInput.vue';
    import MediaButton from '@/Components/MediaButton.vue';
    import CkEditor from '@/Components/CkEditor.vue';
    import Checkbox from '@/Components/Checkbox.vue';

    export default{
        components:{
            ButtonRegular,
            SideModal,
            MultiSelect,
            InputError,
            InputLabel,
            TextInput,
            MediaButton,
            CkEditor,
            Checkbox
        },
        props:{
            data: {
                type: Object,
                required: true
            },
            edit: {
                type: Boolean,
                required: true
            },
            packagedata: {
                type: Object,
                required: true
            },
        },
        data(){
            return{
                current: 0,
                show: false,
                packageid: 0,
                form: this.initialize(),
                errors: [],
            }
        },
        methods:{
            initialize(){
                return {
                    goal_id: 0,
                    board_id: 0,
                    class_id: 0,
                    subjects: [],
                    thumbnail_id: '',
                    title: '',
                    code: '',
                    description: '',
                    validity_type: 'days',
                    valid_for: '',
                    valid_from: '',
                    valid_to: '',
                    package_type: '',
                    is_paid: '',
                    is_trial_available: 0,
                    enrollment_start_date: '',
                    enrollment_end_date: '',
                    trial_duration: 0,
                    is_published: false,
                    instructions: '',
                    is_external_course: false
                }
            },
            store(published){
                let vm = this;
                vm.form.is_published = published;
                axios.post(route('ecommerce.packages.store'), vm.form).then(response => {
                    vm.$inertia.visit(route('ecommerce.packages.edit', {package: response.data.id, slug: 'batch'}));
                    this.$toast.success(response.data.message, {
                        position: 'bottom-right'
                    });
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                    this.$toast.error('Failed to Create Package', {
                            position: 'bottom-right'
                    });
                });
            },
            update(packageid){
                let vm = this;
                axios.put(route('ecommerce.packages.update', {package: packageid}), vm.form).then(response => {
                    if(response.data.success){
                        vm.errors = [];
                        this.$toast.success(response.data.message, {
                            position: 'bottom-right'                   
                        });
                    }
                }).catch(error => {
                    vm.errors = error.response.data.errors;
                    this.$toast.error('Failed to Create Package', {                        
                            position: 'bottom-right'
                    });
                });
            },
            get_children(type, id){
                let vm = this;
                axios.get(route('masterdata.hierarchy.children', {hierarchy: id})).then(response => {
                    vm.data[type] = response.data;
                }).catch(error => {

                });
            },
            close_modal(){
                this.$inertia.visit(route('ecommerce.packages.index'));
            }
        },
        watch:{
            "form.goal_id": function(){
                if(!this.edit){
                    this.data.boards = [];
                    this.data.classes = [];
                    this.form.board_id = 0;
                    this.form.class_id = 0;        
                }
                if(this.form.goal_id){
                    this.get_children('boards', this.form.goal_id);
                }
            },
            "form.board_id": function(){
                if(!this.edit){
                    this.data.classes = [];
                    this.form.class_id = 0;
                }
                if(this.form.board_id){
                    this.get_children('classes', this.form.board_id);
                }
            },
            "form.class_id": function(){
                if(!this.edit){
                    this.data.subjects = [];
                    this.form.subjects = [];
                }
                if(this.form.class_id){
                    this.get_children('subjects', this.form.class_id);
                }
            },
            "form.is_paid": function(){
                if(!this.form.is_paid){
                    this.form.is_trial_available = 0;
                }
            },
            "form.is_external_course": function(){
                if(!this.form.is_external_course){
                    this.form.instructions = '';
                }
            }
        },
        mounted(){
            if (this.edit) {
                this.form = this.packagedata;
            }
        }
    }
</script>

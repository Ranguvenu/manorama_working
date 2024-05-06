<template>
    <div class="flex justify-between items-center">
        <div>
            <div class="flex">
                <BulkUpload :sample="userssample" title="Users" :headers="headers"  component="App\Imports\DataMigrations\UsersMigrations" @refresh="$emit('refresh')"/> 
                <BulkUpload :sample="leadssample" title="Leads" :headers="leadheaders"  component="App\Imports\DataMigrations\LeadsMigration" @refresh="$emit('refresh')"/> 
                <BulkUpload :sample="callrequestssample" title="Call Requests" :headers="headers"  component="App\Imports\DataMigrations\CallRequestsMigration" @refresh="$emit('refresh')"/>
                <BulkUpload :sample="downloadableresourcessample" title="Downloadable Resources" :headers="DownloadableResourcesheaders"  component="App\Imports\DataMigrations\DownloadableResourcesMigration" @refresh="$emit('refresh')"/>
            </div>
            <div class="flex">
                <BulkUpload :sample="subjectsample" title="Hierarchy(Subjects)" :headers="Subjectheaders"  component="App\Imports\DataMigrations\SubjectsMigration" @refresh="$emit('refresh')"/>
                <BulkUpload :sample="packagessample" title="Packages" :headers="packageheaders"  component="App\Imports\DataMigrations\PackageMigration" @refresh="$emit('refresh')"/>
                <!-- <BulkUpload :sample="batchcoursessample" title="Batch Courses" :headers="batchheaders"  component="App\Imports\DataMigrations\BatchCoursesMigration" @refresh="$emit('refresh')"/> -->
                <BulkUpload :sample="batchessample" title="Batches" :headers="Batchesheaders"  component="App\Imports\DataMigrations\BatchesMigration" @refresh="$emit('refresh')"/>
                <BulkUpload :sample="packagepricingsample" title="Package Pricing" :headers="PackagePricingheaders"  component="App\Imports\DataMigrations\PackagePricingMigration" @refresh="$emit('refresh')"/>
		        <BulkUpload :sample="couponssample" title="Coupons" :headers="Couponsheaders"  component="App\Imports\DataMigrations\CouponsMigration" @refresh="$emit('refresh')"/>
                <!-- <JsonImporter :sample="couponssample" title="Transactions" :headers="Couponsheaders"  component="App\Imports\DataMigrations\TransactionsMigration" @refresh="$emit('refresh')"/> -->
                <BulkUpload :sample="transactionsample" title="Transactions" :headers="Transactionheaders"  component="App\Imports\DataMigrations\TmpTransactionsMigration" @refresh="$emit('refresh')"/>
            </div>      
        </div>
    </div>
</template>
<script>
    import BulkUpload from '@/Modules/BulkUpload/index.vue';
    import JsonImporter from '@/Modules/JsonUpload/index.vue';
    export default{
        components:{
            BulkUpload,
            JsonImporter
        },
        props:{
            type: {
                type: Object,
                required: true
            },
            current: {
                type: Number,
                required: false,
                default: 0
            }
        },
        data(){
            return{
                userssample: '/samplesheets/Migrationsheets/users_import_sample.csv',
                leadssample: '/samplesheets/Migrationsheets/leads_import_sample.csv',
                callrequestssample: '/samplesheets/Migrationsheets/callrequests_import_sample.csv',
                downloadableresourcessample: '/samplesheets/Migrationsheets/downloadableresources_import_sample.csv',
                subjectsample: '/samplesheets/Migrationsheets/subjects_import_sample.csv',
                packagessample: '/samplesheets/Migrationsheets/packages_import_sample.csv',
		        batchessample: '/samplesheets/Migrationsheets/batches_import_sample.csv',
                packagepricingsample: '/samplesheets/Migrationsheets/packagepricing_import_sample.csv',
                batchcoursessample: '/samplesheets/Migrationsheets/batchcourses_import_sample.csv',
		        couponssample: '/samplesheets/Migrationsheets/coupons_import_sample.csv',
                transactionsample: '/samplesheets/Migrationsheets/transactions_import_sample.csv',
                headers: {  
                    name: 'Name',
                    email: 'Email',
                    firstname: 'Firstname',
                    lastname: 'Lastname',
                    password: 'Password',
                    country_code: 'Country Code',
                    phone_number: 'Phonenumber'
                },
                leadheaders: {
                    old_id: 'Old_id',
                    name: 'name',
                    country_code: 'country_code',
                    phone_number: 'phone_number',
                    email: 'email',
                    source: 'source',
                    tags: 'tags',
                    received_from: 'received_from',
                    agent_email: 'agent_email'
                },
                DownloadableResourcesheaders: {
                    old_id: 'Old_id',
                    title: 'Title',
                    description: 'Description',
                    publish_from: 'Publish From',
                    publish_to: 'Publish To',
                    resource_type: 'Resource Type',
                    resource: 'Resource',
                    is_active:'Is Active'

                },
                Batchesheaders:{
                    old_id: 'Old_id',
                    name:'Name',
                    code:'Code',
                    batch_start_date:'Batch Start Date',
                    batch_end_date: 'Batch End Date',
                    enrollment_start_date: 'Enrollment Start Date',
                    enrollment_end_date: 'Enrollment End Date',
                    duration:'Duration',
                    student_limit:'Student Limit',
                    batch_provider :'Batch Provider',
                    created_on: 'Created On',
                    updated_on:'Updated On',
                },
                PackagePricingheaders:{
                    old_id: 'Old_id',
                    actual_price:'Actual Price',
                    selling_price:'Selling Price',
                    sap_type:'SAP Type',
                    sap_sub_type:'SAP Sub Type',
                    sap_ism_amount:'SAP ISM Amount',
                    sap_ism_product_code: 'SAP ISM Product Code',
                    subject_ids: 'Subject Ids'
                },
                Subjectheaders: {
                    old_id: 'Old_id',
                    classcode: 'Class Code',
                    title: 'Title',
                    code: 'Code',
                    description: 'Description',
                    image: 'Image',
                    tags: 'Tags'
                },
                Couponsheaders:{
                    old_id: 'Old_id',
                    discount_type:'Discount Type',
                    discount_value:'Discount Value',
                    valid_from: 'Valid From',
                    valid_to: 'Valid To',
                    created_at: 'Created At',
                    updated_at: 'Updated At',

                },
                packageheaders: {
                    old_id: 'old_id',
                    goal_code: 'goal_code',
                    board_code: 'board_code',
                    class_code: 'class_code',
                    courses: 'courses',
                    validity_type: 'validity_type',
                    validity_type_value: 'validity_type_value',
                    thumbnail: 'thumbnail',
                    title: 'title',
                    code: 'code',
                    description: 'description',
                    valid_from: 'valid_from',
                    valid_to: 'valid_to',
                    package_type: 'package_type',
                    payment_type: 'payment_type',
                    is_trial_available: 'is_trial_available',
                    is_published: 'is_published',
                    created_at: 'created_at',
                    updated_at: 'updated_at',
                    created_by: 'created_by',
                    updated_by: 'updated_by',
                },
                batchheaders: {
                    old_id: 'old_id',
                    subject_code: 'subject_code',
                    package_code: 'package_code',
                    name: 'name',
                    code: 'code',
                    description: 'description',
                    thumbnail: 'thumbnail',
                },
                Transactionheaders:{                    
                    transaction_id:'Transaction Id',
                    package_id:'Package Id  ',
                    user_id: 'User Id',
                    status: 'Status'
          

                }
            }
        },
        methods:{
            
        },
        mounted(){
            
        }
    }
</script>

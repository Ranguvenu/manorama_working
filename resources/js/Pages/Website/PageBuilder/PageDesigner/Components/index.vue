<template>
    <div class="builder-component-wrapper" :class="{'inactive': !component.visible}" @mouseover="hover = true" @mouseleave="hover = false">
        <div :class="{'border-primary border-2 position-relative': hover}">
            <div class="bg-primary h-auto py-2 px-3 w-auto builder-action-icons flex" v-if="hover">
                <ArrowsPointingOutIcon class="me-2 h-5 w-5 text-white cursor-pointer"/>
                <EyeIcon v-on:click="update_visibility(0)" v-if="component.visible" class="h-5 w-5 text-white cursor-pointer"/>
                <EyeSlashIcon v-on:click="update_visibility(1)" v-if="!component.visible" class="h-5 w-5 text-white cursor-pointer"/>
                <DocumentDuplicateIcon v-on:click="duplicate_component" class="h-5 mx-2 w-5 text-white cursor-pointer"/>
                <Cog8ToothIcon v-on:click="edit_component" class="h-5 w-5 text-white cursor-pointer"/>
                <XMarkIcon v-on:click="delete_component" class="h-5 w-5 ms-2 text-white cursor-pointer"/>
            </div>
            <ComponentBase :data="configuration.advanced">
                <component v-bind:is="component.component" :preview="preview" :data="configuration" @update-configuration="update_configuration" @update-advanced-configuration="update_advanced_configuration" @close-settings="preview_component" @save-settings="save_component"></component>
            </ComponentBase>
        </div>
    </div>
</template>
<script>
import FeatureCards from "./FeatureCards/index.vue";
import ClientCarousels from "./ClientCarousels/index.vue";
import NumberCounter from "./NumberCounter/index.vue";
import ComponentBase from "./ComponentBase.vue";
import ImageText from "./ImageText/index.vue";
import CtaBlock from "./CtaBlock/index.vue";
import Faq from "./Faq/index.vue";
import NewsLetter from "./NewsLetter/index.vue";
import Testimonials from "./Testimonials/index.vue";
import HomeBanner from "./HomeBanner/index.vue";
import TextEditor from "./TextEditor/index.vue";
import JobPostings from "./JobPostings/index.vue";
import IntroBanner from "./IntroBanner/index.vue";
import Instructors from "./Instructors/index.vue";
import TwoColumnImageAlternating from "./TwoColumnImageAlternating/index.vue";
import Slider from "./Slider/index.vue";
import Blogs from "./Blogs/index.vue";
import DownloadableResources from "./DownloadableResources/index.vue";
import CourseHighlights from "./CourseHighlights/index.vue";
import SiteMap from "./SiteMap/index.vue";
import ContactPage from "./ContactPage/index.vue";
import CardsWithCTA from "./CardsWithCTA/index.vue";
import LeadCapturePage from "./LeadCapturePage/index.vue";
import ResourcePersons from "./ResourcePersons/index.vue";
import CourseCurriculum from "./CourseCurriculum/index.vue";
import K12Package from './K12Package/index.vue';
import CEPackage from './CEPackage/index.vue';
import MCPackage from './MCPackage/index.vue';
import ScrollToTabs from './ScrollToTabs/index.vue';
import SchoolExams from "./SchoolExams/index.vue";
import CourseListing from "./CourseListing/index.vue";
import EnquiryPage from "./EnquiryPage/index.vue";
import FreeResources from "./FreeResources/index.vue";
import K12ListingBanner from "./K12ListingBanner/index.vue";
import K12LandingBanner from "./K12LandingBanner/index.vue";
import StudyMaterials from "./StudyMaterials/index.vue";
import CTALayoutTwo from "./CTALayoutTwo/index.vue";
import CTALayoutThree from "./CTALayoutThree/index.vue";
import CountryCarousel from "./CountryCarousel/index.vue";
import OurMentors from "./OurMentors/index.vue";
import TestimonialsLayoutTwo from "./TestimonialsLayoutTwo/index.vue";
import TwoColAccordionImage from "./TwoColAccordionImage/index.vue";
import CertificateCourses from "./CertificateCourses/index.vue";
import PackageRating from "./PackageRating/index.vue";
import MCLandingBanner from "./MCLandingBanner/index.vue";
import OtherCourses from "./OtherCourses/index.vue";
import ExamListing from "./ExamListing/index.vue";
import Guruvandanam from "./Guruvandanam/index.vue";
import Videolist from "./Videolist/index.vue";
import ReadMore from "./ReadMore/index.vue";
import VideoPlayer from "./VideoPlayer/index.vue";
import FreeTest from "./FreeTest/index.vue";
import TestPackage from "./TestPackage/index.vue";
import OurOfferings from "./OurOfferings/index.vue";
import NEATKEAMPackage from "./NEATKEAMPackage/index.vue";
import { EyeIcon, EyeSlashIcon, DocumentDuplicateIcon, ArrowsPointingOutIcon, Cog8ToothIcon, XMarkIcon, ChevronRightIcon, ChevronDownIcon } from '@heroicons/vue/24/outline'

export default{
    props:{
        component:{
            type: Object,
            required: true
        },
        configuration: {
            type: Object,
            required: true
        },
        page: {
            type: Number,
            required: true
        }
    },
    components:{
        ChevronRightIcon,
        ChevronDownIcon,
        DocumentDuplicateIcon,
        ArrowsPointingOutIcon,
        Cog8ToothIcon,
        XMarkIcon,
        EyeIcon,
        EyeSlashIcon,
        ComponentBase,
        'feature-cards': FeatureCards,
        'client-carousels' : ClientCarousels,
        'number-counter' : NumberCounter,
        'image-text' : ImageText,
        'cta-block' : CtaBlock,
        'faq' : Faq,
        'news-letter' : NewsLetter,
        'testimonials': Testimonials,
        'home-banner': HomeBanner,
        'texteditor' : TextEditor,
        'jobpostings': JobPostings,
        'introbanner': IntroBanner,
        'instructors': Instructors,
        'twocolumnimagealternating': TwoColumnImageAlternating,
        'slider': Slider,
        'blogs': Blogs,
        'downloadableresources': DownloadableResources,
        'course-highlights' : CourseHighlights,
        'site-map' : SiteMap,
        'contact-page' : ContactPage,
        'cards-with-cta' : CardsWithCTA,
        'lead-capture-page' : LeadCapturePage,
        'resource-persons' : ResourcePersons,
        'course-curriculum' : CourseCurriculum,
        'package': K12Package,
        'cepackage': CEPackage,
        'mcpackage': MCPackage,
        'scrolltotabs': ScrollToTabs,
        'school-exams'  : SchoolExams,
        'course-listing' : CourseListing,
        'enquiry-page'  : EnquiryPage,
        'free-resources' : FreeResources,
        'k12-listing-banner' : K12ListingBanner,
        'k12-landing-banner' : K12LandingBanner,
        'studymaterials' : StudyMaterials,
        'cta-layout-two' : CTALayoutTwo,
        'cta-layout-three' : CTALayoutThree,
        'certificate-courses': CertificateCourses,
        'country-carousel' : CountryCarousel,
        'our-mentor'    : OurMentors,
        'testimonials-layout-two' : TestimonialsLayoutTwo,
        'two-col-accordion-image'   : TwoColAccordionImage,
        'package-rating'    : PackageRating,
        'mc-landing-banner' : MCLandingBanner,
        'other-courses' : OtherCourses,
        'exam-listing'  : ExamListing,
  	    'guruvandanam' : Guruvandanam,
        'videolist': Videolist,
        'readmore'      : ReadMore,
        'video-player'  : VideoPlayer,
        'free-test'     : FreeTest,
        'test-package'  : TestPackage,
        'our-offerings' : OurOfferings,
        'neatkeamp-package': NEATKEAMPackage
    },
    emits: ['delete-component', 'save-configuration'],
    data(){
        return{
            show: true,
            preview: true,
            data: {
                settings: {},
                advanced: {}
            },
            hover: false,
        }
    },
    methods:{
        delete_component(){
            this.$emit('delete-component', this.component.id);
        },
        duplicate_component(){
            this.$emit('duplicate-component', this.component.id)
        },
        edit_component(){
            this.preview = false;
        },
        preview_component(){
            this.preview = true;
        },
        save_component(){
            this.$emit('save-configuration', this.component.id, this.data);
            this.preview = true;
        },
        update_visibility(status){
            this.$emit('update-visibility', this.component.id, status)
        },
        update_configuration(configuration){
            this.data.settings = configuration;
        },
        update_advanced_configuration(configuration){
            this.data.advanced = configuration;
        }
    },
    mounted(){

    }
}
</script>

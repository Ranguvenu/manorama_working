<template>
    <ComponentBase :data="configuration.advanced">
        <component v-bind:is="component" :data="configuration.settings"></component>
    </ComponentBase>
</template>
<script>
import FeatureCards from "./FeatureCards/view.vue";
import ClientCarousels from "./ClientCarousels/view.vue";
import NumberCounter from "./NumberCounter/view.vue";
import ComponentBase from "./ComponentBase.vue";
import ImageText from "./ImageText/view.vue";
import CtaBlock from "./CtaBlock/view.vue";
import Faq from "./Faq/view.vue";
import NewsLetter from "./NewsLetter/view.vue";
import Testimonials from "./Testimonials/view.vue";
import HomeBanner from "./HomeBanner/view.vue";
import TextEditor from "./TextEditor/view.vue";
import JobPostings from "./JobPostings/view.vue";
import IntroBanner from "./IntroBanner/view.vue";
import Instructors from "./Instructors/view.vue";
import TwoColumnImageAlternating from "./TwoColumnImageAlternating/view.vue";
import Slider from "./Slider/view.vue";
import Blogs from "./Blogs/view.vue";
import DownloadableResources from "./DownloadableResources/view.vue";
import SiteMap from "./SiteMap/view.vue";
import ContactPage from "./ContactPage/view.vue";
import CardsWithCTA from "./CardsWithCTA/view.vue";
import LeadCapturePage from "./LeadCapturePage/view.vue";
import ResourcePersons from "./ResourcePersons/view.vue";
import CourseCurriculum from "./CourseCurriculum/view.vue";
import K12Package from './K12Package/view.vue';
import CEPackage from './CEPackage/view.vue';
import MCPackage from './MCPackage/view.vue';
import ScrollToTabs from './ScrollToTabs/view.vue';
import SchoolExams from "./SchoolExams/view.vue";
import CourseListing from "./CourseListing/view.vue";
import EnquiryPage from "./EnquiryPage/view.vue";
import FreeResources from "./FreeResources/view.vue";
import K12ListingBanner from "./K12ListingBanner/view.vue";
import K12LandingBanner from "./K12LandingBanner/view.vue";
import StudyMaterials from "./StudyMaterials/view.vue";
import CTALayoutTwo from "./CTALayoutTwo/view.vue";
import CountryCarousel from "./CountryCarousel/view.vue";
import TestimonialsLayoutTwo from "./TestimonialsLayoutTwo/view.vue";
import TwoColAccordionImage from "./TwoColAccordionImage/view.vue";
import CertificateCourses from "./CertificateCourses/view.vue";
import PackageRating from "./PackageRating/view.vue";
import MCLandingBanner from "./MCLandingBanner/view.vue";
import OtherCourses from "./OtherCourses/view.vue";
import CourseHighlights from "./CourseHighlights/view.vue";
import ExamListing from "./ExamListing/view.vue";
import CTALayoutThree from "./CTALayoutThree/view.vue";
import Guruvandanam from "./Guruvandanam/view.vue";
import Videolist from "./Videolist/view.vue";
import ReadMore from "./ReadMore/view.vue";
import VideoPlayer from "./VideoPlayer/view.vue";
import FreeTest from "./FreeTest/view.vue";
import TestPackage from "./TestPackage/view.vue";
import OurOfferings from "./OurOfferings/view.vue";
import OurMentors from "./OurMentors/view.vue";
import NEATKEAMPackage from "./NEATKEAMPackage/view.vue";


export default {
    props: {
        component: {
            type: String,
            required: true
        },
        configuration: {
            type: Object,
            required: true
        },
    },
    components: {
        ComponentBase,
        'feature-cards': FeatureCards,
        'client-carousels': ClientCarousels,
        'number-counter': NumberCounter,
        'image-text': ImageText,
        'cta-block': CtaBlock,
        'faq': Faq,
        'news-letter': NewsLetter,
        'testimonials': Testimonials,
        'home-banner': HomeBanner,
        'texteditor': TextEditor,
        'jobpostings': JobPostings,
        'introbanner': IntroBanner,
        'instructors': Instructors,
        'twocolumnimagealternating': TwoColumnImageAlternating,
        'slider': Slider,
        'blogs': Blogs,
        'downloadableresources': DownloadableResources,
        'site-map': SiteMap,
        'contact-page': ContactPage,
        'cards-with-cta': CardsWithCTA,
        'lead-capture-page': LeadCapturePage,
        'resource-persons': ResourcePersons,
        'course-curriculum': CourseCurriculum,
        'package': K12Package,
        'cepackage': CEPackage,
        'mcpackage': MCPackage,
        'scrolltotabs': ScrollToTabs,
        'school-exams': SchoolExams,
        'course-listing': CourseListing,
        'enquiry-page': EnquiryPage,
        'free-resources': FreeResources,
        'k12-listing-banner': K12ListingBanner,
        'k12-landing-banner': K12LandingBanner,
        'studymaterials': StudyMaterials,
        'country-carousel' : CountryCarousel,
        'testimonials-layout-two' : TestimonialsLayoutTwo,
        'two-col-accordion-image': TwoColAccordionImage,
        'certificate-courses' : CertificateCourses,
        'package-rating'    : PackageRating,
        'mc-landing-banner' : MCLandingBanner,
        'other-courses' : OtherCourses,
        'course-highlights' : CourseHighlights,
        'exam-listing' : ExamListing,
        'cta-layout-two' : CTALayoutTwo,
        'cta-layout-three' : CTALayoutThree,
   	    'guruvandanam' : Guruvandanam,
        'videolist': Videolist,
        'readmore'      : ReadMore,
        'video-player'  : VideoPlayer,
        'free-test'     : FreeTest,
        'test-package'  : TestPackage,
        'our-offerings' : OurOfferings,
        'our-mentor'    : OurMentors,
        'neatkeamp-package' : NEATKEAMPackage


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

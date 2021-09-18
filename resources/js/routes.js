 import Home from './components/Home';
// import WhyWara from './components/WhyWara';
// import Management from './components/Management';
// import Directors from './components/Directors';
// import Departments from './components/Departments';
// import Departments_Details from './components/Departments_Details';
// import Doctors from './components/Doctors';
// import Doctors_Details from './components/Doctors_Details';
// import Awards from './components/Awards';
// import NewsMedias from './components/NewsMedias';
// import Activities from './components/Activities';
// import Medias from './components/Medias';
// import Publications from './components/Publications';
// import Testimonials from './components/Testimonials';
// import Careers from './components/Careers';
// import Contact from './components/Contact';
// import Appointment  from './components/Appointment';
// import AppointmentDoctors  from './components/AppointmentDoctors';
// import Page from './components/Page';
// import PCR from './components/PCR';
// import Booking from './components/Booking';
// import FailedBooking from './components/FailedBooking';
// import Tour from './components/Tour';
// import Sitemap from './components/Sitemap';
// import Search from './components/Search';

export default {
    mode: 'history',

    linkActiveClass: 'link-active',

    routes: [
        {
            path: '*',
            redirect() {
                if(document.documentElement.lang.substr(0, 2) == 'en'){
                    return 'en';
                }
                return 'ar';
            }
        },
        {

            path: '/:',
            component: {
                template: '<router-view v-bind:key="$route.fullPath"></router-view>'
            },
            beforeEnter: (to, from, next) => { // <------------
                const locale = to.params.lang; // 1
                console.log('loc:',to);
                const supported_locales = ['en','ar']; // 2
                if (!supported_locales.includes(locale)){
                    if(document.documentElement.lang.substr(0, 2) == 'en'){
                        return next('en');
                    }
                    return next('ar');
                }  // 3
                return next(); // 5
            },
            children: [
                {
                    path: '/:',
                    name: 'home',
                    component: Home
                }

            ]
        }
    ]
}

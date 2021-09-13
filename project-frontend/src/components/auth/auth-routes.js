import Login from './Login';
import Registration from './Registration';
import ForgotPassword from './ForgotPassword';
import Verification from './Verification';
import ThankYouPage from "./ThankYouPage";

export default [
    {path: '/login', name: 'Login', component: Login},
    {path: '/signUp', name: 'Registration', component: Registration},
    {path: '/forgot', name: 'Forgot-Password', component: ForgotPassword, props: true},
    {path: '/verification/:email/:token', name: 'Verification', component: Verification},
    {path: '/thanks/:rFrom', name: 'ThankYou', component: ThankYouPage}
]

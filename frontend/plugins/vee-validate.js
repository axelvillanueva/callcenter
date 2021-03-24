import { extend } from "vee-validate";
import { required, email, alpha_spaces } from "vee-validate/dist/rules";

extend('alpha_spaces', {
    ...alpha_spaces,
    message: "The field is invalid"
});

extend('email', {
    ...email,
    message: "The field must be a valid email"
});

extend('required', {
    ...required,
    message: "The field is required"
});

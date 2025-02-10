import Pristine from "pristinejs";
import Toastify from "toastify-js";
import axios from "axios";

(function (cash) {
    "use strict";

    function onSubmit(pristine) {
        let valid = pristine.validate();

        if (valid) {
            Toastify({
                node: cash("#success-notification-content")
                    .clone()
                    .removeClass("hidden")[0],
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
            }).showToast();
            return true;
        } else {
            Toastify({
                node: cash("#failed-notification-content")
                    .clone()
                    .removeClass("hidden")[0],
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
            }).showToast();
            return false;
        }
    }

    cash(".validate-form").each(function () {
        let pristine = new Pristine(this, {
            classTo: "input-form",
            errorClass: "has-error",
            errorTextParent: "input-form",
            errorTextClass: "text-theme-6 mt-2",
        });

        pristine.addValidator(
            cash(this).find('input[type="url"]')[0],
            function (value) {
                let expression = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi;
                let regex = new RegExp(expression);
                if (!value.length || (value.length && value.match(regex))) {
                    return true;
                }
                return false;
            },
            "This field is URL format only",
            2,
            false
        );

        cash(this).on("submit", function (e) {
            if(onSubmit(pristine) === true) { return; }
            e.preventDefault();
        });
    });

    cash("#formBuilderForm").each(function () {
        let pristine = new Pristine(this, {
            classTo: "input-form",
            errorClass: "has-error",
            errorTextParent: "input-form",
            errorTextClass: "text-theme-6 mt-2",
        });

        pristine.addValidator(
            cash(this).find('input[type="url"]')[0],
            function (value) {
                let expression = /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi;
                let regex = new RegExp(expression);
                if (!value.length || (value.length && value.match(regex))) {
                    return true;
                }
                return false;
            },
            "This field is URL format only",
            2,
            false
        );

        cash(this).on("submit", function (e) {
            e.preventDefault();
            if(onSubmit(pristine) === true) {
                console.log(cash('input[name="name"]').val());
                console.log(cash("#formBuilderForm").attr('action'));
                console.log(cash("#formBuilderForm").data('type'));
                axios.post(cash("#formBuilderForm").attr('action'), {
                    name: cash('input[name="name"]').val(),
                    fields: formBuilder.actions.getData('json', true),
                    _method: cash("#formBuilderForm").data('type'),
                })
                    .then(function (response) {
                        console.log(response.data);
                        if(response.data.status == 'success') {
                            if(cash("#formBuilderForm").data('type') === 'put') {
                                //location.href = '/forms/'+cash("#formBuilderForm").data('id')+'/edit';
                            } else {
                                location.href = '/forms';
                            }

                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        });
    });
})(cash);

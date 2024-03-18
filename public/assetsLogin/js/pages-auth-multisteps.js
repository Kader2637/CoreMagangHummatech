"use strict"; $((function () { var e = $(".select2"); e.length && e.each((function () { var e = $(this); e.wrap('<div class="position-relative"></div>'), e.select2({ placeholder: "Select an country", dropdownParent: e.parent() }) })) })), document.addEventListener("DOMContentLoaded", (function (e) { !function () { const e = document.querySelector("#multiStepsValidation"); if (void 0 !== typeof e && null !== e) { const t = e.querySelector("#multiStepsForm"), n = t.querySelector("#accountDetailsValidation"), a = t.querySelector("#personalInfoValidation"), i = t.querySelector("#billingLinksValidation"), s = [].slice.call(t.querySelectorAll(".btn-next")), o = [].slice.call(t.querySelectorAll(".btn-prev")), r = document.querySelector(".multi-steps-exp-date"), l = document.querySelector(".multi-steps-cvv"), m = document.querySelector(".multi-steps-mobile"), u = document.querySelector(".multi-steps-pincode"), c = document.querySelector(".multi-steps-card"); r && new Cleave(r, { date: !0, delimiter: "/", datePattern: ["m", "y"] }), l && new Cleave(l, { numeral: !0, numeralPositiveOnly: !0 }), m && new Cleave(m, { phone: !0, phoneRegionCode: "US" }), u && new Cleave(u, { delimiter: "", numeral: !0 }), c && new Cleave(c, { creditCard: !0, onCreditCardTypeChanged: function (e) { document.querySelector(".card-type").innerHTML = "" != e && "unknown" != e ? '<img src="' + assetsPath + "img/icons/payments/" + e + '-cc.png" height="28"/>' : "" } }); let d = new Stepper(e, { linear: !0 }); const p = FormValidation.formValidation(n, { fields: { multiStepsUsername: { validators: { notEmpty: { message: "Please enter username" }, stringLength: { min: 6, max: 30, message: "The name must be more than 6 and less than 30 characters long" }, regexp: { regexp: /^[a-zA-Z0-9 ]+$/, message: "The name can only consist of alphabetical, number and space" } } }, multiStepsEmail: { validators: { notEmpty: { message: "Please enter email address" }, emailAddress: { message: "The value is not a valid email address" } } }, multiStepsPass: { validators: { notEmpty: { message: "Please enter password" } } }, multiStepsConfirmPass: { validators: { notEmpty: { message: "Confirm Password is required" }, identical: { compare: function () { return n.querySelector('[name="multiStepsPass"]').value }, message: "The password and its confirm are not the same" } } } }, plugins: { trigger: new FormValidation.plugins.Trigger, bootstrap5: new FormValidation.plugins.Bootstrap5({ eleValidClass: "", rowSelector: ".col-sm-6" }), autoFocus: new FormValidation.plugins.AutoFocus, submitButton: new FormValidation.plugins.SubmitButton }, init: e => { e.on("plugins.message.placed", (function (e) { e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement) })) } }).on("core.form.valid", (function () { d.next() })), g = FormValidation.formValidation(a, { fields: { multiStepsFirstName: { validators: { notEmpty: { message: "Please enter first name" } } }, multiStepsAddress: { validators: { notEmpty: { message: "Please enter your address" } } } }, plugins: { trigger: new FormValidation.plugins.Trigger, bootstrap5: new FormValidation.plugins.Bootstrap5({ eleValidClass: "", rowSelector: function (e, t) { switch (e) { case "multiStepsFirstName": return ".col-sm-6"; case "multiStepsAddress": return ".col-md-12"; default: return ".row" } } }), autoFocus: new FormValidation.plugins.AutoFocus, submitButton: new FormValidation.plugins.SubmitButton } }).on("core.form.valid", (function () { d.next() })), S = FormValidation.formValidation(i, { fields: { multiStepsCard: { validators: { notEmpty: { message: "Please enter card number" } } } }, plugins: { trigger: new FormValidation.plugins.Trigger, bootstrap5: new FormValidation.plugins.Bootstrap5({ eleValidClass: "", rowSelector: function (e, t) { return "multiStepsCard" === e ? ".col-md-12" : ".col-dm-6" } }), autoFocus: new FormValidation.plugins.AutoFocus, submitButton: new FormValidation.plugins.SubmitButton }, init: e => { e.on("plugins.message.placed", (function (e) { e.element.parentElement.classList.contains("input-group") && e.element.parentElement.insertAdjacentElement("afterend", e.messageElement) })) } }).on("core.form.valid", (function () {})); s.forEach((e => { e.addEventListener("click", (e => { switch (d._currentIndex) { case 0: p.validate(); break; case 1: g.validate(); break; case 2: S.validate() } })) })), o.forEach((e => { e.addEventListener("click", (e => { switch (d._currentIndex) { case 2: case 1: d.previous() } })) })) } }() }));

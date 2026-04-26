// password validation
let pass = document.getElementById("password")
let isEight = document.getElementById("isEight")
let hasNums = document.getElementById("hasNums")
let hasChars = document.getElementById("hasChars")
let confPass = document.getElementById("confPass")
let submit = document.getElementById("submit")
pass.addEventListener("input", function(e) {
	e.preventDefault()
	let val = pass.value
	let cpass = confPass.value
	isEight.style.color = (val.length < 8 || val.length > 20) ? "red" : "green"
	hasNums.style.color = (!/[0-9]/.test(val)) ? "red" : "green"
	hasChars.style.color = (!/[^a-z0-9]/.test(val)) ? "red" : "green"
})
confPass.addEventListener("input", function(e) {
	e.preventDefault()
	let val = pass.value
	let cpass = confPass.value
	const isValid = (val.length >= 8 && val.length <= 20) 
		&& (/[0-9]/.test(val)) && (/[^a-z0-9]/.test(val))
	const isSame = val !== "" && cpass !== "" && val === cpass
	submit.disabled = !(isValid && isSame)
})
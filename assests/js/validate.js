console.log('haah')
// validate
let rules = {
    nameProduct : {
        required : true,
        minlength : 4,
        maxlength : 10,
    },
    price : {
        required : true,
    },
    oddPrice : {
        required :  true,
    }
}
// method rules
const methodRules = {
    required : (inputText,param) => {
        return inputText ? true : false
    },
    minlength : (inputText,param)=> {
        return inputText.length >= param ? true : false
    },
    maxlength : (innerText,param)=> {
        return innerText.length <= param ? true: false
    }
}
// message error
const messageError = {
    nameProduct_required : 'Ten san pham ko dc bo trong',
    nameProduct_minlength : 'Ten san pham phai co hon 4 ki tu',
    nameProduct_maxlength : 'Ten san pham phai co it hon 10 ki tu',
    price_required : 'Gia ko dc bo rong',
    oddPrice_required : 'Gia cu ko dc bo trong'
}

// handle event
const handleEvent = (e) => {
    for (let ruleItem in rules) {
        // console.log(ruleItem)
        const ruleItemAll = rules[ruleItem]
        const inputSelector = document.querySelector('.' + ruleItem)
        const inputText = inputSelector.value ;
        inputSelector.classList.remove('error')
        inputSelector.nextElementSibling.innerText = ''
        for (let ruleVal in ruleItemAll) {
            // console.log(ruleVal)
            const param = ruleItemAll[ruleVal]
            const result = methodRules[ruleVal](inputText,param)
            if (!result) {
                const message = messageError[`${ruleItem}_${ruleVal}`]
                inputSelector.classList.add('error');
                inputSelector.nextElementSibling.innerText = message
                break
            }
        }
    }
    e.preventDefault();
}

// add event
const formCreate = document.forms.formCreate;
    formCreate.addEventListener('submit',handleEvent)
    formCreate.addEventListener('input',handleEvent)
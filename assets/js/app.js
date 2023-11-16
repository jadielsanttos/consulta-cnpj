// Variables
const inputCnpj = document.getElementById('input_cnpj')
const btnSend = document.getElementById('btn_send')
const areaResult = document.querySelector('.section_single .area_section .area_result')
const itemsResultadoCnpj = document.querySelectorAll('.section_single .area_section .area_result .item_result')
const areaLoading = document.querySelector('.area_loading')
const areaModalTermosDeUso = document.querySelector('.section_single .area_section .area_modal_termos_de_uso')
const strongOpenModal = document.querySelector('.section_single .area_section .area_termos_de_uso .right_side span strong')
const iconCloseModal = document.querySelector('.section_single .area_section .area_modal_termos_de_uso .modal .btn_close_modal')
const textCloseModal = document.querySelector('.section_single .area_section .area_modal_termos_de_uso .modal .content_modal #single_paragraph')

// Events
btnSend.addEventListener('click', (e) => {
    if(inputCnpj.value.length > 18 || inputCnpj.value.length < 18) {
        alert('CNPJ inválido')
        e.preventDefault()
    }else {
        controlaLoading()
    }
})

inputCnpj.addEventListener('keyup', () => {
    inputCnpj.value = validarCNPJ(inputCnpj.value)
})

itemsResultadoCnpj.forEach(item => {
    item.addEventListener('click', () => {
        let conteudoParaSerCopiado = item.childNodes[1].childNodes[1].innerText
        navigator.clipboard.writeText(conteudoParaSerCopiado)
    })
})

strongOpenModal.addEventListener('click', () => {
    areaModalTermosDeUso.style.display = 'flex'
})

iconCloseModal.addEventListener('click', closeModalTermosDeUso)
textCloseModal.addEventListener('click', closeModalTermosDeUso)

// Functions
function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/\D/g, '')
    cnpj = cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5')
    return cnpj
}

function verificaAreaResultado() {
    let quantidadeItemsResultado = document.querySelector('.area_result').children.length

    if(quantidadeItemsResultado == 6) {
        document.querySelector('.section_single .area_section .title h1').style.marginTop = '200px'
    }
}

function controlaLoading() {
    if(areaResult == null) {
        areaLoading.style.display = 'block'
    }
}

function closeModalTermosDeUso() {
    areaModalTermosDeUso.style.display = 'none'
}

verificaAreaResultado()
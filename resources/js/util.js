
export function hideElem(elem) {
    elem.classList.add('d-none');
    elem.classList.remove('d-block');
}

export function showElem(elem) {
    elem.classList.add('d-block');
    elem.classList.remove('d-none');
}
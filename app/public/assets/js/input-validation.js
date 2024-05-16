
function showHiddenInput(){

    const value_select=document.querySelector('.select-class').value;

    const street_conx=document.querySelector('.select-address-component');

    const street_conlgx=document.querySelector('.selct-di-component-add');

    street_conx.style.display='none';

    street_conlgx.style.display='none';

    if(value_select === 'Mjini'){
        street_conx.style.display='block';
        street_conx.style.animation='FadeClass 2s';
    }
    else if(value_select === 'Iyunga'){
        street_conlgx.style.display='block';
        street_conlgx.style.animation='FadeClass 2s';
    }
}

function showHiidenEmailInput(){
    const email_validator=document.querySelector('.email-validator').value;

    const validEmail=document.querySelector('.email-value-valid');

    validEmail.style.display='none';

    if(email_validator === '1'){
        validEmail.style.display='block';
        validEmail.style.animation='FadeClass 2s';
    }
}

function showEditForm(){
    document.querySelector('.loaded-edit-form').classList.toggle('active');
}

function loadNewsForm(){
    document.querySelector('.post-upd-new').classList.toggle('active');
}

function showNewsAttachment()
{
    document.querySelector('.attachment-componet').classList.toggle('active');
}

function showHiddenAttachment()
{
    document.querySelector('.attachment-image').classList.toggle('active');
}

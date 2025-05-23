document.addEventListener("DOMContentLoaded", () =>{
    const addToCartPopup = new Popup({
        id: "add-to-cart-popup",
        title: "Dodano przedmiot do koszyka",
        content: `{btn-confirm}[Potwierdź]`,
    });

    function addToCartSuccess(){
        addToCartPopup.show();
    }       
});
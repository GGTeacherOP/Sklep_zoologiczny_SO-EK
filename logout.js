document.addEventListener("DOMContentLoaded", () =>{
    const logoutBtn = document.querySelector(".logout-btn")

    const singOutPopup = new Popup({
        id: "sign-out-popup",
        title: "Czy napewno chcesz się wylogować?",
        content: `{btn-confirm}[Wyloguj]`,
    });

    logoutBtn.addEventListener("click", () => {
            singOutPopup.show();
            document.querySelector(".confirm")?.addEventListener("click", () =>{
                window.location.href = "home.php?logout=true";
        });
    });
});
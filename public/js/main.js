import '../scss/main.scss';

let mobileDropdowns = document.querySelectorAll('.main-menu__mobile-dropdown');
let mobileSecondDropdowns =
    document.querySelectorAll('.main-menu__mobile-dropdown-seconds');

let allDropdowns = [
    {selectors: mobileDropdowns, childClass: '.main-menu__mobile-ul'},
    {
        selectors: mobileSecondDropdowns,
        childClass: '.main-menu__mobile-ul-seconds',
    },
];

allDropdowns.map((dropdowns) => {
    // 註冊點擊事件
    Array.prototype.forEach.call(dropdowns.selectors, (el, i) => {
        el.addEventListener('click', (e) => {
            // let childUl = e.target.querySelectorAll(dropdowns.childClass)[0];

            // 有套用符合的 class name 才需判斷是否開關
            // * 不能使用 currentTarget 判斷，否則會觸發到父元素的點擊事件，因為已經有 show class, 會將父層選單關閉
            // * 使用當前的 target
            // if (childUl) {
            if (!e.currentTarget.classList.contains('show')) {
                removeShowAttr();

                e.currentTarget.classList.add('show');
                // childUl.classList.add('show');
            } else {
                removeShowAttr();
            }
            // }
            event.stopPropagation();
        });
    });

    /**
    移除顯示狀態 (需另外跑一個迴圈, 因為 click event 只會註冊到當前的 element)
    **/
    function removeShowAttr() {
        Array.prototype.forEach.call(dropdowns.selectors, (el, i) => {
            el.classList.remove('show');
            // el.querySelectorAll(dropdowns.childClass)[0].classList.remove('show');
        });
    };
});

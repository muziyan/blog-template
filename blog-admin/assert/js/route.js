class Route {
    /* container 是放置html_string的容器 */
    /*
    * routes 是跳转路由数组
    * [{path:"/",component:"Home",fn:fn}]
    * path => history路由地址
    * component => 需要获取的html_string 页面
    * fn => 是需要在html_string加载完后执行的function 可传数组或者单个
    * */
    constructor(container,{routes}) {
        this.container = container;
        this.routes = routes;
        this.init();
        this.bindClick();
    }

    /* 初始化 */
    init(){
        this.updateView();
        window.addEventListener("popstate",this.updateView.bind(this))
    }

    /* 绑定点击视图跳转 */
    bindClick(){
        let pushTo = document.querySelectorAll("a[to]");
        [].forEach.call(pushTo,item =>{
            item.addEventListener("click",()=>{
                let path = item.getAttribute("to");
                if (path === window.location.pathname) return false;
                let title = path.split("/")[1];
                window.history.pushState({},title,path)
                this.updateView()
            })
        })
    }

    /* 更新视图 */
    updateView(){
        let self = this;
        let pathname = window.location.pathname;
        this.routes.filter(item => {
            if (item.path === pathname){
                self.getView(item.component)
                    .then(html_str =>{
                        self.container.innerHTML = html_str;
                        item.fns && self.loadScript(item.fns)
                    })
            }
        })
    }

    /* 使用fetch获取html字符串 异步返回*/
    getView(component){
        return fetch(`./View/${component}.html`)
            .then(res => res.text())
    }

    /* 加载需要在view获取后执行的function */
    loadScript(fns){
        typeof fns === "object" ? fns.filter(fn => fn()) : fns();
    }
}
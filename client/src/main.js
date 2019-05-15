import Vue from "vue";
import router from "./router";
import store from "./store";
import App from "./App";
import "./plugins";
import "./components";

import ApiService from "./services/ApiService";

ApiService.init(process.env.VUE_APP_API_ENTRYPOINT);

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount("#app");

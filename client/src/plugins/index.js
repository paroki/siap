import Vue from "vue";
import Vuetify from "vuetify";
import theme from "./theme";
import icons from "./icons";

import "@mdi/font/css/materialdesignicons.css";

Vue.use(Vuetify, {
    iconfont: "mdi",
    theme,
    icons
});

//import 'material-design-icons-iconfont/dist/material-design-icons.css';
import "vuetify/dist/vuetify.min.css";
import "@/styles/index.scss";

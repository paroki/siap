import { createStore } from "vuex"
import ui from './ui/store'

export default createStore({
    modules: {
        ui
    }
})
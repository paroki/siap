import {BASE_URL} from "./config";
import Routing from "fos-router";

const url = new URL(BASE_URL);
const routing = Routing
routing.setHost(url.host);
export default routing
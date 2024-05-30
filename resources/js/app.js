import Cookies from 'js-cookie';
import EquipoAPI from "./API/EquipoAPI.js";
import PrestamoAPI from "./API/PrestamoAPI.js";
import MessagesAPI from "./API/MessagesAPI.js";
import UserAPI from "./API/UserAPI.js";
import HTTPClient from "./API/HTTPClient.js";
import CompositeProcesses from "./API/CompositeProcesses.js";
import Alerts from "./Alerts.js";

const userAPI = new UserAPI(HTTPClient);
const equipoAPI = new EquipoAPI(HTTPClient);
const prestamoAPI = new PrestamoAPI(HTTPClient);
const messagesAPI = new MessagesAPI(HTTPClient);
const compositeProcesses = new CompositeProcesses(prestamoAPI, equipoAPI, messagesAPI);
const alerts = new Alerts(compositeProcesses);

window.MessagesAPI = messagesAPI;
window.PrestamoAPI = prestamoAPI;
window.EquipoAPI = equipoAPI;
window.UserAPI = userAPI;
window.CompositeProcesses = compositeProcesses;
window.Alerts = alerts;

window.Cookies = Cookies;

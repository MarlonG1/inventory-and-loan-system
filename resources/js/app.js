import Cookies from 'js-cookie';
import InventarioAPI from "./API/InventarioAPI.js";
import LicenciaAPI from "./API/LicenciaAPI.js";
import PrestamoAPI from "./API/PrestamoAPI.js";
import MessagesAPI from "./API/MessagesAPI.js";
import UserAPI from "./API/UserAPI.js";
import HTTPClient from "./API/HTTPClient.js";
import CompositeProcesses from "./API/CompositeProcesses.js";
import Alerts from "./Alerts.js";

const userAPI = new UserAPI(HTTPClient);
const inventarioAPI = new InventarioAPI(HTTPClient);
const prestamoAPI = new PrestamoAPI(HTTPClient);
const licenciaAPI = new LicenciaAPI(HTTPClient);
const messagesAPI = new MessagesAPI(HTTPClient);
const compositeProcesses = new CompositeProcesses(prestamoAPI, inventarioAPI, messagesAPI);
const alerts = new Alerts(compositeProcesses);

window.MessagesAPI = messagesAPI;
window.PrestamoAPI = prestamoAPI;
window.InventarioAPI = inventarioAPI;
window.UserAPI = userAPI;
window.LicenciaAPI = licenciaAPI;
window.CompositeProcesses = compositeProcesses;
window.Alerts = alerts;

window.Cookies = Cookies;

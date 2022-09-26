import React from "react";
import ReactDOM from "react-dom";
import {BrowserRouter as Router} from "react-router-dom";
import {DSProvider} from "@synerise/ds-core/dist/js";
import App from "./App";
import "@synerise/ds-dropdown/dist/style/index.css";
import './style.css';
import '../../../styles/antd-animations.css';

window.addEventListener("load", async function () {

	ReactDOM.render(
		<Router>
			<DSProvider>
				<App />
			</DSProvider>
		</Router>,
		document.getElementById("synerise-for-woocommerce-root")
	);
});


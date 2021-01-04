import React from "react";
import Navigation from "./Navigation";
import {BrowserRouter as Router, Route, Switch} from "react-router-dom";
import Content from "./Content";
import {Routing} from "../routing";

export default function Application() {
    return (
        <Router forceRefresh={true}>
            <Navigation/>

            <Switch>
                {Routing.map(({path, exact = true, page}, key) => (
                    <Route {...{key, path, exact}}>
                        <Content {...{page}}/>
                    </Route>
                ))}
            </Switch>
        </Router>
    );
}

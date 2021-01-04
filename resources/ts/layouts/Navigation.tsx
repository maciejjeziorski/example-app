import React from "react";
import {Link} from "react-router-dom";

export default function Navigation() {
    return (
        <nav className="navbar navbar-expand-lg navbar-light bg-light">
            <div className="container-fluid">
                <Link to="/" className="navbar-brand">Example App</Link>

                <button className="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"/>
                </button>

                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                        <li className="nav-item">
                            <Link to="/client-panel" className="nav-link">Client panel</Link>
                        </li>
                        <li className="nav-item">
                            <Link to="/admin-panel" className="nav-link">Admin panel</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    );
}

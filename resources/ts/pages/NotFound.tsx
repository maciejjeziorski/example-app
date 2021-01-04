import React from "react";
import {Link} from "react-router-dom";

export default function NotFound() {
    return (
        <div className="text-center">
            <h1 className="display-1">404</h1>
            <h2 className="display-4 text-muted">Page not found</h2>

            <Link to="/" className="btn btn-primary mt-5">Back to Homepage</Link>
        </div>
    );
}

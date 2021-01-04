import React from "react";
import {Link} from "react-router-dom";

export default function AdminDashboard() {
    return (
        <div className="row">
            <div className="col-sm-6">
                <div className="card">
                    <div className="card-body">
                        <h5 className="card-title">Projects</h5>
                        <p className="card-text">Projects with tasks assigned to them.</p>
                        <Link to="/admin-panel/projects" className="btn btn-primary">Browse projects</Link>
                        <Link to="/admin-panel/projects/create" className="btn btn-light ms-2">Create a new
                            project</Link>
                    </div>
                </div>
            </div>
            <div className="col-sm-6">
                <div className="card">
                    <div className="card-body">
                        <h5 className="card-title">Tasks</h5>
                        <p className="card-text">Each task is assigned to a project using a one-to-many
                            relationship.</p>
                        <a href="#" className="btn btn-light disabled">Available in projects</a>
                    </div>
                </div>
            </div>
        </div>
    );
}

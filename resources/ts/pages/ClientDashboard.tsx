import React, {useEffect, useState} from "react";
import {Link} from "react-router-dom";
import axios from "axios";
import Pagination from "../components/Pagination";
import Header from "../components/Header";

export default function ClientDashboard() {
    const [callbackUrl, setCallbackUrl] = useState("/api/projects");
    const [response, setResponse] = useState([]);
    const [projects, links] = [
        response?.data || [],
        response?.meta?.links || []
    ];

    useEffect(() => {
        axios.get(callbackUrl).then(response => {
            setResponse(response?.data || []);
        }).catch(() => {
            alert("Ooops... Something went wrong!");
        });
    }, [callbackUrl]);

    return (
        <>
            <Header title="Projects"/>

            <div className="row">
                {projects.map((project, key) => (
                    <div className="col-xs-12 col-md-6 col-lg-4 col-xl-3 mb-4" key={key}>
                        <div className="card">
                            <div className="card-body">
                                <h5 className="card-title">
                                    {project.name}
                                </h5>
                                <h6 className="card-subtitle mb-2">
                                    {project.client ? (
                                        <span className="text-primary">{project.client}</span>
                                    ) : (
                                        <span className="text-muted">Internal (without client)</span>
                                    )}
                                </h6>
                                <p className="card-text">
                                    {project.short_description}
                                </p>
                            </div>
                            <ul className="list-group list-group-flush">
                                {project.tasks_count > 0 ? (
                                    <li className="list-group-item">
                                        Tasks:
                                        <span
                                            className="badge ms-1 bg-light text-dark">{project.completed_tasks_count} completed</span>
                                        <span className="badge ms-1 bg-dark">{project.tasks_count} in total</span>
                                    </li>
                                ) : (
                                    <li className="list-group-item">No tasks</li>
                                )}
                            </ul>
                            <div className="card-body">
                                <Link to={`/client-panel/${project.slug}`} href="#" className="btn btn-primary">View
                                    tasks</Link>
                            </div>
                        </div>
                    </div>
                ))}

                <div className="col-12">
                    <Pagination links={links} handleClick={setCallbackUrl}/>
                </div>
            </div>
        </>
    );
}

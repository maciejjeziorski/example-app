import React, {useEffect, useState} from "react";
import {Link, useParams} from "react-router-dom";
import axios from "axios";
import Table from "../../components/Table";
import Pagination from "../../components/Pagination";

export default function Show() {
    const {project: projectSlug} = useParams()
    const [callbackUrl, setCallbackUrl] = useState(`/api/projects/${projectSlug}/tasks`);
    const [response, setResponse] = useState([]);
    const [tasks, project, links, currentPage, perPage, tasksCount] = [
        response?.data || [],
        response?.project || [],
        response?.meta?.links || [],
        response?.meta?.current_page || 1,
        response?.meta?.per_page || 1,
        response?.meta?.total || 0,
    ];

    useEffect(() => {
        axios.get(callbackUrl).then(response => {
            setResponse(response.data || []);
        }).catch(() => {
            alert("Ooops... Something went wrong!");
        });
    }, [callbackUrl]);

    return (
        <>
            <h1 className="display-5 d-flex">
                <span className="flex-fill text-muted">{project.name}</span>
                <span>
                    <Link to="/client-panel" className="btn btn-light">
                        <i className="far fa-arrow-alt-circle-left text-muted me-2"/>
                        Back to projects
                    </Link>
                </span>
            </h1>
            <h2 className="display-6 fs-4 text-muted mb-4">
                {project.client ? (
                    <span className="text-primary">{project.client}</span>
                ) : (
                    <span className="text-muted">Internal (without client)</span>
                )}
            </h2>

            <div className="row">
                <div className="col-3">
                    {project.description && (
                        <>
                            <p className="lead mb-0">Description</p>
                            <p>{project.description}</p>
                        </>
                    )}

                    <p className="lead mb-0">Stats</p>
                    <p>
                        {tasksCount > 0 ? (
                            <span className="badge bg-dark">{tasksCount} tasks in total</span>
                        ) : (
                            <span className="badge bg-light text-dark">no tasks</span>
                        )}
                    </p>
                </div>
                <div className="col-9">
                    <Table
                        head={[
                            {children: "No.", className: "text-center"},
                            {children: "Task"},
                            {children: "Priority", className: "text-center"},
                            {children: "Status", className: "text-center"},
                            {children: "Due date", className: "text-center"},
                            {children: null},
                        ]}
                        body={tasks.map((task, key) => (
                            <tr key={key}>
                                <td className="text-center">
                                    {(key + 1) + ((currentPage - 1) * perPage)}
                                </td>
                                <td>
                                    <Link to={`/client-panel/${project.slug}/${task.slug}`}
                                          children={task.title}
                                    />
                                </td>
                                <td className="text-center">
                                    <span className={"badge " + task.priority_css_classes}>
                                        {task.priority_label}
                                    </span>
                                </td>
                                <td className="text-center">
                                    <span className={"badge " + task.status_css_classes}>
                                        {task.status_label}
                                    </span>
                                </td>
                                <td className="text-center">
                                    {task.due_date || (
                                        <span className="text-muted">&mdash;</span>
                                    )}
                                </td>
                                <td className="text-center">
                                    <Link to={`/client-panel/${project.slug}/${task.slug}`}
                                          className="btn btn-sm btn-default text-muted"
                                          title="Details"
                                          children={<i className="far fa-share-square"/>}
                                    />
                                </td>
                            </tr>
                        ))}
                    />

                    <Pagination links={links} handleClick={setCallbackUrl}/>
                </div>
            </div>
        </>
    );
}

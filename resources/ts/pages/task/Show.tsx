import React, {useEffect, useState} from "react";
import {Link, useParams} from "react-router-dom";
import axios from "axios";
import TaskStatusForm from "../../forms/TaskStatusForm";

export default function Show() {
    const {project: projectSlug, task: taskSlug} = useParams()
    const [task, setTask] = useState([]);

    useEffect(() => {
        axios.get(`/api/projects/${projectSlug}/tasks/${taskSlug}`).then(response => {
            setTask(response?.data?.data || []);
        }).catch(() => {
            alert("Ooops... Something went wrong!");
        });
    }, []);

    return (
        <>
            <h1 className="display-5 d-flex">
                <span className="flex-fill text-muted">{task.title}</span>
                <span>
                    <Link to={`/client-panel/${projectSlug}`} className="btn btn-light">
                        <i className="far fa-arrow-alt-circle-left text-muted me-2"/>
                        Back to project
                    </Link>
                </span>
            </h1>
            <h2 className="display-6 fs-4 text-muted mb-4">
                <span className={"badge me-2 " + task.priority_css_classes}>
                    <i className="fas fa-fire me-2"/>
                    {task.priority_label + " priority"}
                </span>

                {task.due_date && (
                    <span className={"badge bg-light text-dark"}>
                    <i className="far fa-clock me-2"/>
                        {"Due date: " + task.due_date}
                </span>
                )}
            </h2>

            {task.description && <>
                <p className="lead">Description</p>
                <p>{task.description}</p>
            </>}

            <p className="lead">Status</p>

            <TaskStatusForm
                submitMethod={"PATCH"}
                submitUrl={`/api/projects/${projectSlug}/tasks/${taskSlug}/status`}
                initUrl={`/api/projects/${projectSlug}/tasks/${taskSlug}/edit`}
                redirectPath={`/client-panel/${projectSlug}`}
            />
        </>
    );
}

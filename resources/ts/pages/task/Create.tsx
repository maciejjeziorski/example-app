import React from "react";
import {useParams} from "react-router-dom";
import TaskForm from "../../forms/TaskForm";
import Header from "../../components/Header";

export default function Create() {
    const {project: projectSlug} = useParams();

    return (
        <>
            <Header title="Create task"/>

            <TaskForm
                submitMethod={"POST"}
                submitUrl={`/api/projects/${projectSlug}/tasks`}
                initUrl={`/api/projects/${projectSlug}/tasks/create`}
                redirectPath={`/admin-panel/projects/${projectSlug}/tasks`}
                cancelPath={`/admin-panel/projects/${projectSlug}/tasks`}
                submitButtonLabel={"Store"}
            />
        </>
    );
}

import React from "react";
import {useParams} from "react-router-dom";
import TaskForm from "../../forms/TaskForm";
import Header from "../../components/Header";

export default function Edit() {
    const {project: projectSlug, task: taskSlug} = useParams();

    return (
        <>
            <Header title="Edit task"/>

            <TaskForm
                submitMethod={"PUT"}
                submitUrl={`/api/projects/${projectSlug}/tasks/${taskSlug}`}
                initUrl={`/api/projects/${projectSlug}/tasks/${taskSlug}/edit`}
                redirectPath={`/admin-panel/projects/${projectSlug}/tasks`}
                cancelPath={`/admin-panel/projects/${projectSlug}/tasks`}
                submitButtonLabel={"Update"}
            />
        </>
    );
}

import React from "react";
import {useParams} from "react-router-dom";
import ProjectForm from "../../forms/ProjectForm";
import Header from "../../components/Header";

export default function Edit() {
    const {project: projectSlug} = useParams();

    return (
        <>
            <Header title="Edit project"/>

            <ProjectForm
                submitMethod={"PUT"}
                submitUrl={`/api/projects/${projectSlug}`}
                initUrl={`/api/projects/${projectSlug}/edit`}
                redirectPath={"/admin-panel/projects"}
                cancelPath={"/admin-panel/projects"}
                submitButtonLabel={"Update"}
            />
        </>
    );
}

import React from "react";
import ProjectForm from "../../forms/ProjectForm";
import Header from "../../components/Header";

export default function Create() {
    return (
        <>
            <Header title="Create project"/>

            <ProjectForm
                submitMethod={"POST"}
                submitUrl={"/api/projects"}
                initUrl={null}
                redirectPath={"/admin-panel/projects"}
                cancelPath={"/admin-panel/projects"}
                submitButtonLabel={"Store"}
            />
        </>
    );
}

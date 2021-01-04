import React, {useEffect, useState} from "react";
import {Link, useHistory} from "react-router-dom";
import axios from "axios";
import Table from "../../components/Table";
import Pagination from "../../components/Pagination";
import Header from "../../components/Header";

export default function Index() {
    const history = useHistory();
    const [callbackUrl, setCallbackUrl] = useState("/api/projects");
    const [projects, setProjects] = useState([]);
    const [links, setLinks] = useState([]);

    useEffect(() => {
        axios.get(callbackUrl).then(response => {
            setProjects(response.data?.data || []);
            setLinks(response.data?.meta?.links || []);
        })
    }, [callbackUrl]);

    const destroyModel = (projectSlug) => {
        if (confirm("Are you sure?")) {
            axios.delete(`/api/projects/${projectSlug}`).then(() => {
                history.push("/admin-panel/projects");
            }).catch(() => {
                alert("Ooops... Something went wrong!");
            });
        }
    }

    return (
        <>
            <Header title="Projects"/>

            <div className="text-end">
                <Link to="/admin-panel/projects/create" className="btn btn-primary">
                    Create a new project
                </Link>
            </div>

            <Table
                head={[
                    {children: "Name"},
                    {children: "Client"},
                    {children: "Tasks", className: "text-center"},
                    {children: "Actions", className: "text-end"},
                ]}
                body={projects.map((project, key) => (
                    <tr key={key}>
                        <td>
                            <Link to={`/admin-panel/projects/${project.slug}/tasks`}>
                                {project.name}
                            </Link>
                        </td>
                        <td>
                            {project.client || (
                                <em className="text-muted">&mdash;</em>
                            )}
                        </td>
                        <td className="text-center">
                            {project.tasks_count > 0 ? (
                                <>
                                    <span
                                        className="badge text-dark bg-light">{project.completed_tasks_count} completed</span>
                                    <span className="badge ms-1 bg-dark">{project.tasks_count} in total</span>
                                </>
                            ) : (
                                <span className="badge text-dark bg-light">no tasks</span>
                            )}
                        </td>
                        <td className="text-end">
                            <Link to={`/client-panel/${project.slug}`}
                                  className="btn btn-sm btn-default text-muted"
                                  title="Show (Client panel)"
                                  children={<i className="far fa-eye"/>}
                            />
                            <Link to={`/admin-panel/projects/${project.slug}/edit`}
                                  className="btn btn-sm btn-default text-muted"
                                  title="Edit"
                                  children={<i className="far fa-edit"/>}
                            />
                            <a onClick={() => destroyModel(project.slug)}
                               className="btn btn-sm btn-default text-danger"
                               title="Delete"
                               children={<i className="far fa-trash-alt"/>}
                            />
                        </td>
                    </tr>
                ))}
            />

            <Pagination links={links} handleClick={setCallbackUrl}/>
        </>
    );
}

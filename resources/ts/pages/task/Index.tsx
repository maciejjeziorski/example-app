import React, {useEffect, useState} from "react";
import axios from "axios";
import {Link, useHistory, useParams} from "react-router-dom";
import Table from "../../components/Table";
import Pagination from "../../components/Pagination";
import Header from "../../components/Header";

export default function Index() {
    const history = useHistory();
    const {project: projectSlug} = useParams();
    const [callbackUrl, setCallbackUrl] = useState(`/api/projects/${projectSlug}/tasks`);
    const [tasks, setTasks] = useState([]);
    const [project, setProject] = useState([]);
    const [links, setLinks] = useState([]);

    useEffect(() => {
        axios.get(callbackUrl).then(response => {
            setTasks(response.data?.data || []);
            setProject(response.data?.project || [])
            setLinks(response.data?.meta?.links || []);
        }).catch(() => {
            alert("Ooops... Something went wrong!");
        });
    }, [callbackUrl]);

    const destroyModel = (projectSlug, taskSlug) => {
        if (confirm("Are you sure?")) {
            axios.delete(`/api/projects/${projectSlug}/tasks/${taskSlug}`).then(() => {
                history.push(`/admin-panel/projects/${projectSlug}/tasks`);
            }).catch(() => {
                alert("Ooops... Something went wrong!");
            });
        }
    }

    return (
        <>
            <Header title={(project.name || "Project") + " - tasks"}/>

            <div className="row">
                <div className="col">
                    <Link to="/admin-panel/projects" className="btn btn-light">
                        Back to projects
                    </Link>
                </div>
                <div className="col text-end">
                    <Link to={`/admin-panel/projects/${projectSlug}/tasks/create`} className="btn btn-primary">
                        Create a new task
                    </Link>
                </div>
            </div>

            <Table
                head={[
                    {children: "Title"},
                    {children: "Priority", className: "text-center"},
                    {children: "Status", className: "text-center"},
                    {children: "Due date", className: "text-center"},
                    {children: "Actions", className: "text-end"},
                ]}
                body={tasks.map((task, key) => (
                    <tr key={key}>
                        <td>
                            <Link to={`/admin-panel/projects/${projectSlug}/tasks/${task.slug}/edit`}>
                                {task.title}
                            </Link>
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
                            {task.due_date || <span className="text-muted">&mdash;</span>}
                        </td>
                        <td className="text-end">
                            <Link to={`/client-panel/${projectSlug}/${task.slug}`}
                                  className="btn btn-sm btn-default text-muted"
                                  title="Show (Client panel)"
                                  children={<i className="far fa-eye"/>}
                            />
                            <Link to={`/admin-panel/projects/${projectSlug}/tasks/${task.slug}/edit`}
                                  className="btn btn-sm btn-default text-muted"
                                  title="Edit"
                                  children={<i className="far fa-edit"/>}
                            />
                            <a onClick={() => destroyModel(projectSlug, task.slug)}
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

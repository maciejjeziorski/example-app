import React from "react";
import {Pages as Page} from "./pages";

export const Routing = [
    /*
     * Client panel
     */
    {
        path: "/client-panel",
        page: Page.Client.Dashboard,
    }, {
        path: "/client-panel/:project",
        page: Page.Client.Project.Show,
    }, {
        path: "/client-panel/:project/:task",
        page: Page.Client.Task.Show,
    },

    /*
     * Admin panel
     */
    {
        path: "/admin-panel",
        page: Page.Admin.Dashboard,
    }, {
        path: "/admin-panel/projects",
        page: Page.Admin.Project.Index,
    }, {
        path: "/admin-panel/projects/create",
        page: Page.Admin.Project.Create,
    }, {
        path: "/admin-panel/projects/:project/edit",
        page: Page.Admin.Project.Edit,
    }, {
        path: "/admin-panel/projects/:project/tasks",
        page: Page.Admin.Task.Index,
    }, {
        path: "/admin-panel/projects/:project/tasks/create",
        page: Page.Admin.Task.Create,
    }, {
        path: "/admin-panel/projects/:project/tasks/:task/edit",
        page: Page.Admin.Task.Edit,
    },

    /*
     * Other
     */
    {
        path: "/",
        title: "Home",
        page: Page.Home,
    }, {
        path: "/",
        exact: false,
        page: Page.NotFound,
    },
];

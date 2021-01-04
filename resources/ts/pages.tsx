import React from "react";
import NotFoundPage from "./pages/NotFound";
import HomePage from "./pages/Home";
import AdminDashboardPage from "./pages/AdminDashboard";
import ClientDashboardPage from "./pages/ClientDashboard";
import ProjectIndexPage from "./pages/project/Index";
import ProjectShowPage from "./pages/project/Show";
import ProjectCreatePage from "./pages/project/Create";
import ProjectEditPage from "./pages/project/Edit";
import TaskIndexPage from "./pages/task/Index";
import TaskShowPage from "./pages/task/Show";
import TaskCreatePage from "./pages/task/Create";
import TaskEditPage from "./pages/task/Edit";

export const Pages = {
    Home: HomePage,
    NotFound: NotFoundPage,
    Admin: {
        Dashboard: AdminDashboardPage,
        Project: {
            Index: ProjectIndexPage,
            Create: ProjectCreatePage,
            Edit: ProjectEditPage,
        },
        Task: {
            Index: TaskIndexPage,
            Create: TaskCreatePage,
            Edit: TaskEditPage,
        },
    },
    Client: {
        Dashboard: ClientDashboardPage,
        Project: {
            Show: ProjectShowPage,
        },
        Task: {
            Show: TaskShowPage,
        },
    }
};

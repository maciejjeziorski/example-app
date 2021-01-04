import React, {useEffect, useState} from "react";
import {useForm} from "react-hook-form";
import axios from "axios"
import {useHistory} from "react-router-dom";

export function useAppForm(
    {submitMethod, submitUrl, initUrl, redirectPath}: UseAppFormProps
) {
    const history = useHistory();
    const formMethods = useForm();
    const {setError, setValue} = formMethods;

    const [initData, setInitData] = useState([]);

    useEffect(() => {
        if (initUrl !== null) {
            axios.request({
                method: "GET",
                url: initUrl,
            }).then(({data}) => {
                setInitData(data);

                if (typeof data.data === "object") {
                    for (const [fieldName, fieldValue] of Object.entries(data.data)) {
                        setValue(fieldName, fieldValue);
                    }
                }
            }).catch(() => {
                alert("Ooops... Something went wrong!");
            });
        }
    }, []);

    const onSubmit = data => {
        axios.request({
            method: submitMethod,
            url: submitUrl,
            data: data
        }).then(() => {
            history.push(redirectPath);
        }).catch(({response}) => {
            if (
                response?.status === 422 &&
                typeof response.data.errors === "object" &&
                typeof response.data.message === "string"
            ) {
                // Set server errors
                for (const [fieldName, errorsList] of Object.entries(response.data.errors)) {
                    if (Array.isArray(errorsList)) {
                        setError(fieldName, {
                            type: "server",
                            message: errorsList.join(" ")
                        });
                    }
                }

                alert(response.data.message);
            } else {
                alert("Ooops... Something went wrong!");
            }
        });
    };

    return {
        initData,
        onSubmit,
        ...formMethods
    };
}

export type UseAppFormProps = {
    submitMethod: "POST" | "PUT" | "PATCH",
    submitUrl: string,
    initUrl: string | null,
    redirectPath: string,
};

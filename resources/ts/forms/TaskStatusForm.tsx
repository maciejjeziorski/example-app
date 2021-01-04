import React from "react";
import HorizontalInput from "../components/HorizontalInput";
import {Input} from "../components/Input";
import {useAppForm, UseAppFormProps} from "../hooks/useAppForm";

export default function TaskStatusForm(
    {submitMethod, submitUrl, initUrl, redirectPath}: TaskStatusFormProps
) {
    const {register, errors, handleSubmit, onSubmit, initData, setValue, watch} = useAppForm({
        submitMethod,
        submitUrl,
        initUrl,
        redirectPath,
    });

    return (
        <form onSubmit={handleSubmit(onSubmit)}>
            <HorizontalInput label={"Change status"} children={(
                <div className="d-flex">
                        <span className="flex-fill">
                            <Input.Select name="status"
                                          error={errors?.status?.message || null}
                                          options={initData?.config_data?.statuses || []}
                                          register={register}
                            />
                        </span>
                    <span>
                        <button type="submit" className="btn btn-primary ms-2">Confirm</button>
                    </span>
                </div>
            )}/>
        </form>
    );
}

type TaskStatusFormProps = UseAppFormProps;

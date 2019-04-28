@extends('layouts.app')

@section('template')
<style>
    h1{
        font-family: Raleway;
        font-weight: 100;
        text-align: center;
    }
    #vscode_container_outline{
        border: 1px solid #ddd;
        /* padding:2px; */
        border-radius: 2px;
        margin-bottom:2rem;
        background: #fff;
        overflow: hidden;
    }
    a.action-menu-item:hover{
        text-decoration: none;
    }
    input.form-control {
        height: calc(2.4375rem + 2px);
    }

    .cm-fake-select{
        height: calc(2.4375rem + 2px);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .cm-scrollable-menu::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    .cm-scrollable-menu::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
    }

    .cm-scrollable-menu{
        height: auto;
        max-height: 40vh;
        overflow-x: hidden;
        width: 100%;
        max-width:16rem;
    }

    user-section{
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    user-section > p{
        margin:0;
        line-height: 2rem;
        font-size: 1.2rem;
    }

    .cm-avatar-square{
        height: 1.5rem;
        width: 1.5rem;
        border-radius: 4px;
        margin-right:0.5rem;
    }

    code-paper{
        display: block;
        box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 10px;
        border-radius: 4px;
        transition: .2s ease-out .0s;
        color: #7a8e97;
        background: #fff;
        position: relative;
        border: 1px solid rgba(0, 0, 0, 0.15);
        margin-bottom: 2rem;
        overflow: hidden;
        margin-top:2rem;
    }

    code-paper > code-header{
        display: block;
        line-height: 2rem;
        background: #fafbfc;
        border-bottom: 1px solid rgba(0,0,0,0.15);
        color: #24292e;
        padding:0.25rem 1rem;
        font-size: 0.75rem;
        font-weight: 600;
        font-family: consolas;
    }

    code-paper > pre{
        margin:0;
        padding:1rem;
    }
</style>
<div class="container mundb-standard-container">
    <user-section>
        <img src="https://acm.njupt.edu.cn/static/img/avatar/noj.png" class="cm-avatar-square">
        <p>John Doe</p>
    </user-section>
    <small style="color:rgba(0,0,0,0.42);">Created at 14:15:23 2019/04/28, Expired at 14:15:23 2019/05/28</small>
    <code-paper>
        <code-header>My Awesome Code</code-header>
        <pre data-lang="php" id="pb_content">&lt;?php
    echo $a;</pre>
    </code-paper>
</div>
@endsection

@section('additionJS')
    <script src="/static/library/monaco-editor/min/vs/loader.js"></script>
    <script>
        require.config({ paths: { 'vs': '{{env('APP_URL')}}/static/library/monaco-editor/min/vs' }});

        window.MonacoEnvironment = {
            getWorkerUrl: function(workerId, label) {
                return `data:text/javascript;charset=utf-8,${encodeURIComponent(`
                self.MonacoEnvironment = {
                    baseUrl: '{{env('APP_URL')}}/static/library/monaco-editor/min/'
                };
                importScripts('{{env('APP_URL')}}/static/library/monaco-editor/min/vs/base/worker/workerMain.js');`
                )}`;
            }
        };

        require(["vs/editor/editor.main"], function () {
            monaco.editor.colorizeElement(document.getElementById("pb_content"));
        });
    </script>
@endsection

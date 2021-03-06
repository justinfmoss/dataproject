@extends('layouts.layout')
@section('content')

<style>
    .deleteSubmit {
        background-color: #bcc5cc;
    }
</style>
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<section id="widget-grid">
    <div class="jarviswidget jarviswidget-color-orange jarviswidget-sortable" id="wid-id-0"
         data-widget-editbutton="false" role="widget">
        <header role="heading">
            <div class="jarviswidget-ctrls" role="menu">
                <a href="{{ URL::to('users/create') }}" class="button-icon" rel="tooltip" data-placement="bottom"><i
                        class="fa fa-plus"> Add New SubUser</i></a>
                <a href="#" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" data-placement="bottom"
                   data-original-title="Fullscreen"><i class="fa fa-resize-full"></i></a>
                <a href="#" class="button-icon jarviswidget-delete-btn" rel="tooltip" data-placement="bottom"
                   data-original-title="Delete"><i class="fa fa-times"></i></a>
            </div>
            <span class="widget-icon"><i class="fa fa-sitemap"></i></span>

            <h2>User Tree View</h2>
            <span class="jarviswidget-loader" style="display:none;"><i class="fa fa-refresh fa-spin"></i></span>
        </header>
        <div class="span6 tree stmart-form">
            <ul role="tree">
                @foreach($childtree as $user)
                @if($user->indent == 0)
                <li class="parent_li" role="treeitem">
                    <span title="Collapse this branch"><i class="fa fa-lg fa-minus-circle"></i> {{$user->email}}
                        <span style="transition:none;"><a href="{{ URL::to('users/' . $user->id) }}"> Profile </a></span>
                        <span style="transition:none;"><a href="{{ URL::to('users/' . $user->id . '/edit') }}"> Edit </a></span>
                        <span style="transition:none;">
                            {{ Form::open(array('url' => 'users/' . $user->id, 'class' => 'pull-right')) }}
                            {{ Form::hidden('_method', 'DELETE') }}
                            {{ Form::submit('Delete this User', array('class' => 'deleteSubmit')) }}
                            {{ Form::close() }}
                        </span>
                    </span>
                    <ul id="user{{$user->id}}"></ul>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        var childrenData = [<?php foreach($childtree as $item){ echo $item.','; }?>];

        childrenData.forEach(function (entry, index, array) {
            $("#user" + entry.parent_id).append("<li class='parent_li' role='parent_li'><span title='Collapse this branch'><i class='fa fa-lg fa-minus-circle'></i> " + entry.email + "</span><ul role='group' id='user" + entry.id + "'></ul></li>")
        });

        $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
        $('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Collapse this branch').on('click', function (e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(':visible')) {
                children.hide('fast');
                $(this).attr('title', 'Expand this branch').find(' > i').removeClass().addClass('fa fa-lg fa-plus-circle');
            } else {
                children.show('fast');
                $(this).attr('title', 'Collapse this branch').find(' > i').removeClass().addClass('fa fa-lg fa-minus-circle');
            }
            e.stopPropagation();
        });
        if ($.fn.jarvisWidgets && $.enableJarvisWidgets) {
            $('#widget-grid').jarvisWidgets({
                grid: 'article',
                widgets: '.jarviswidget',
                localStorage: true,
                deleteSettingsKey: '#deletesettingskey-options',
                settingsKeyLabel: 'Reset settings?',
                deletePositionKey: '#deletepositionkey-options',
                positionKeyLabel: 'Reset position?',
                sortable: true,
                buttonsHidden: false,
                // toggle button
                toggleButton: true,
                toggleClass: 'fa fa-minus | fa fa-plus',
                toggleSpeed: 200,
                onToggle: function () {
                },
                // delete btn
                deleteButton: true,
                deleteClass: 'fa fa-times',
                deleteSpeed: 200,
                onDelete: function () {
                },
                // edit btn
                editButton: true,
                editPlaceholder: '.jarviswidget-editbox',
                editClass: 'fa fa-cog | fa fa-save',
                editSpeed: 200,
                onEdit: function () {
                },
                // color button
                colorButton: true,
                // full screen
                fullscreenButton: true,
                fullscreenClass: 'fa fa-resize-full | fa fa-resize-small',
                fullscreenDiff: 3,
                onFullscreen: function () {
                },
                // custom btn
                customButton: false,
                customClass: 'folder-10 | next-10',
                customStart: function () {
                    alert('Hello you, this is a custom button...')
                },
                customEnd: function () {
                    alert('bye, till next time...')
                },
                // order
                buttonOrder: '%refresh% %custom% %edit% %toggle% %fullscreen% %delete%',
                opacity: 1.0,
                dragHandle: '> header',
                placeholderClass: 'jarviswidget-placeholder',
                indicator: true,
                indicatorTime: 600,
                ajax: true,
                timestampPlaceholder: '.jarviswidget-timestamp',
                timestampFormat: 'Last update: %m%/%d%/%y% %h%:%i%:%s%',
                refreshButton: true,
                refreshButtonClass: 'fa fa-refresh',
                labelError: 'Sorry but there was a error:',
                labelUpdated: 'Last Update:',
                labelRefresh: 'Refresh',
                labelDelete: 'Delete widget:',
                afterLoad: function () {
                },
                rtl: false, // best not to toggle this!
                onChange: function () {

                },
                onSave: function () {

                },
                ajaxnav: $.navAsAjax // declears how the localstorage should be saved
            });
        }
    });
</script>
@stop
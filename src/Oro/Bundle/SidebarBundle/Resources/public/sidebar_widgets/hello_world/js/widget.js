/*jslint nomen: true, vars: true*/
/*global define*/

define(['jquery', 'underscore', 'backbone'], function ($, _, Backbone) {
    'use strict';

    /**
     * @export  orosidebar/widget/hello-world
     */
    var helloWorld = {};

    helloWorld.ContentView = Backbone.View.extend({
        template: _.template('<span><%= settings.content %></span>'),

        initialize: function () {
            var view = this;
            view.listenTo(view.model, 'change', view.render);
        },

        render: function () {
            var view = this;
            try {
                view.$el.html(view.template(view.model.toJSON()));
            } catch (ex) {
                // Supressing exceptions for possible syntax errors
                if (console && (typeof console.log === 'function')) {
                    console.log(ex);
                }
            }
            return view;
        }
    });

    helloWorld.SetupView = Backbone.View.extend({
        template: _.template('<h3>Hello world settings</h3><textarea style="width: 400px; height: 150px;"><%= settings.content %></textarea>'),

        initialize: function () {
            this.on('ok', this.onSubmit);
            Backbone.View.prototype.initialize.apply(this, arguments);
        },

        render: function () {
            var view = this;
            view.$el.html(view.template(view.model.toJSON()));
            return view;
        },

        onSubmit: function () {
            var view = this;
            var model = view.model;

            var content = view.$el.find('textarea').val();
            var settings = model.get('settings');

            if (settings.content != content) {
                settings.content = content;
                model.set({ settings: settings }, { silent: true });
                model.trigger('change');
            }

            this.trigger('close');
        }
    });

    return helloWorld;
});

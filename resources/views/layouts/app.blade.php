<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
           <!-- Other head elements -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @include('layouts.heading')

        <!-- Scripts -->
        <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js') }}"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
        .starrr {
            display: inline-block;
        }
        .starrr a {
            font-size: 20px;
            padding: 0 1px;
            cursor: pointer;
            color: #FFD700;
            text-decoration: none;
        }
    </style>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.sidebar')


        @include('layouts.navi')


            <div>
                @yield('content')
            </div>
            @yield('scripts')
    <script>
        (function($, window) {
            var __slice = [].slice;

            (function($, window) {
                var Starrr;

                Starrr = (function() {
                    Starrr.prototype.defaults = {
                        rating: void 0,
                        numStars: 5,
                        change: function(e, value) {}
                    };

                    function Starrr($el, options) {
                        var i, _, _ref,
                            _this = this;

                        this.options = $.extend({}, this.defaults, options);
                        this.$el = $el;
                        _ref = this.defaults;
                        for (i in _ref) {
                            _ = _ref[i];
                            if (this.$el.data(i) != null) {
                                this.options[i] = this.$el.data(i);
                            }
                        }
                        this.createStars();
                        this.syncRating();
                        this.$el.on('mouseover.starrr', 'a', function(e) {
                            return _this.syncRating(_this.$el.find('a').index(e.currentTarget) + 1);
                        });
                        this.$el.on('mouseout.starrr', function() {
                            return _this.syncRating();
                        });
                        this.$el.on('click.starrr', 'a', function(e) {
                            return _this.setRating(_this.$el.find('a').index(e.currentTarget) + 1);
                        });
                        this.$el.on('starrr:change', this.options.change);
                    }

                    Starrr.prototype.createStars = function() {
                        var _i, _ref, _results;
                        _results = [];
                        for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                            _results.push(this.$el.append("<a href='#'><i class='fa fa-star'></i></a>"));
                        }
                        return _results;
                    };

                    Starrr.prototype.setRating = function(rating) {
                        if (this.options.rating === rating) {
                            rating = void 0;
                        }
                        this.options.rating = rating;
                        this.syncRating();
                        return this.$el.trigger('starrr:change', rating);
                    };

                    Starrr.prototype.syncRating = function(rating) {
                        var i, _i, _j, _ref;
                        rating || (rating = this.options.rating);
                        if (rating) {
                            for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                                this.$el.find('a').eq(i).addClass('selected');
                            }
                        }
                        if (rating && rating < 5) {
                            for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                                this.$el.find('a').eq(i).removeClass('selected');
                            }
                        }
                        if (!rating) {
                            return this.$el.find('a').removeClass('selected');
                        }
                    };

                    return Starrr;

                })();
                return $.fn.extend({
                    starrr: function() {
                        var option, _args;
                        option = arguments[0], _args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                        return this.each(function() {
                            var data;
                            data = $(this).data('star-rating');
                            if (!data) {
                                $(this).data('star-rating', (data = new Starrr($(this), option)));
                            }
                            if (typeof option === 'string') {
                                return data[option].apply(data, _args);
                            }
                        });
                    }
                });
            })(window.jQuery, window);

        })(window.jQuery, window);
    </script>
            
        </div>
        @include('layouts.javascript')
    </body>
</html>

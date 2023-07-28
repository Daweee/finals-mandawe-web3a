<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'movie.mov_title' => ['required', 'min:3', 'max:30'],
            'movie.mov_year' => ['required', 'integer', 'min:1895'],
            'movie.mov_time' => ['required', 'numeric', 'min:1'],
            'movie.mov_lang' => ['required', 'min:3', 'max:30', 'alpha', 'regex:/^[A-Za-z]+$/'],
            'movie.mov_dt_rel' => ['required'],
            'movie.mov_rel_country' => ['required', 'size:2', 'regex:/^[A-Z]+$/'],

            'director.dir_fname' => ['required', 'min:3', 'max:30', 'regex:/^[\pL\s]+$/u'],
            'director.dir_lname' => ['required', 'min:3', 'max:30', 'regex:/^[\pL\s]+$/u'],

            'actor.act_fname' => ['required', 'min:3', 'max:30', 'regex:/^[\pL\s]+$/u'],
            'actor.act_lname' => ['required', 'min:3', 'max:30', 'regex:/^[\pL\s]+$/u'],
            'actor.act_gender' => ['required', Rule::in(['M', 'F'])],

            'role' => ['required', 'min:3', 'max:30', 'regex:/^[\pL\s]+$/u'],

            'genre.gen_title' => ['required', 'min:3', 'max:30', 'regex:/^[\pL\s]+$/u'],

            'reviewer.rev_name' => ['required', 'min:3', 'max:30', 'regex:/^[\pL\s]+$/u'],

            'rating.rev_stars' => ['required', 'numeric', 'min:0', 'max:10']
        ];
    }

    public function messages()
    {
        return [
            'movie.mov_title.required' => 'Movie title is required',
            'movie.mov_title.min' => 'Movie title must be at least 3 characters',
            'movie.mov_title.max' => 'Movie title must not exceed 30 characters',

            'movie.mov_year.required' => 'Year is required',
            'movie.mov_year.integer' => 'Year must be a number only',
            'movie.mov_year.min' => 'Year must be at least 1895',

            'movie.mov_time.required' => 'Movie length is required',
            'movie.mov_time.numeric' => 'Movie length must be a number only',
            'movie.mov_time.min' => 'Movie length must be at least 1',

            'movie.mov_lang.required' => 'Language is required',
            'movie.mov_lang.min' => 'Language must be at least 3 characters',
            'movie.mov_lang.max' => 'Language must not exceed 30 characters',
            'movie.mov_lang.alpha' => 'Language must only contain letters',
            'movie.mov_lang.regex' => 'Language must only contain letters',

            'movie.mov_dt_rel.required' => 'Release date is required',

            'movie.mov_rel_country.required' => 'Country of release is required',
            'movie.mov_rel_country.size' => 'Country of release must only be 2 characters (Abbreviation of the country)',
            'movie.mov_rel_country.regex' => 'Country of release must only contain uppercase letters',

            'director.dir_fname.required' => 'Director\'s first name is required',
            'director.dir_fname.min' => 'Director\'s first name must be at least 3 characters',
            'director.dir_fname.max' => 'Director\'s first name must not exceed 30 characters',
            'director.dir_fname.regex' => 'Director\'s first name must only contain letters',

            'director.dir_lname.required' => 'Director\'s last name is required',
            'director.dir_lname.min' => 'Director\'s last name must be at least 3 characters',
            'director.dir_lname.max' => 'Director\'s last name must not exceed 30 characters',
            'director.dir_lname.regex' => 'Director\'s last name must only contain letters',

            'actor.act_fname.required' => 'Actor\'s first name is required',
            'actor.act_fname.min' => 'Actor\'s first name must be at least 3 characters',
            'actor.act_fname.max' => 'Actor\'s first name must not exceed 30 characters',
            'actor.act_fname.regex' => 'Actor\'s first name must only contain letters',

            'actor.act_lname.required' => 'Actor\'s last name is required',
            'actor.act_lname.min' => 'Actor\'s last name must be at least 3 characters',
            'actor.act_lname.max' => 'Actor\'s last name must not exceed 30 characters',
            'actor.act_lname.regex' => 'Actor\'s last name must only contain letters',

            'actor.act_gender.required' => 'Actor\'s gender is required',
            'actor.act_gender.in' => 'Actor\'s gender must be either "M" or "F"',

            'role.required' => 'Role is required',
            'role.min' => 'Role must be at least 3 characters',
            'role.max' => 'Role must not exceed 30 characters',
            'role.alpha' => 'Role must only contain letters',

            'genre.gen_title.required' => 'Genre is required',
            'genre.gen_title.min' => 'Genre must be at least 3 characters',
            'genre.gen_title.max' => 'Genre must not exceed 30 characters',
            'genre.gen_title.alpha' => 'Genre must only contain letters',
            'genre.gen_title.regex' => 'Genre must only contain letters',

            'reviewer.rev_name.required' => 'Reviewer name is required',
            'reviewer.rev_name.min' => 'Reviewer name must be at least 3 characters',
            'reviewer.rev_name.max' => 'Reviewer name must not exceed 30 characters',
            'reviewer.rev_name.alpha' => 'Reviewer name must only contain letters',
            'reviewer.rev_name.regex' => 'Reviewer name must only contain letters',

            'rating.rev_stars.required' => 'Rating is required',
            'rating.rev_stars.numeric' => 'Rating must be a number',
            'rating.rev_stars.min' => 'Rating must be at least 0',
            'rating.rev_stars.max' => 'Rating must not exceed 10',
        ];
    }
}

class UsersController < ApplicationController

	skip_before_action :require_login, only: [:new, :create]
	
	def index
	end

	def new
		redirect_to users_path if logged_in?
		@user=User.new
	end

	def create
		@user=User.new user_params
		if !User.exists?(name: params[:user][:name])
			@user.save
			flash[:success]="Register Success"
			redirect_to users_path
		else
			flash[:success]="Register Failed"
			render :new
		end
	end

	def show
		@user=User.find_by id: params[:id]
		redirect_to users_path if @current_user != @user
	end

	private
	def user_params
		params.require(:user).permit :name, :password, :password_confirmation
    end
end
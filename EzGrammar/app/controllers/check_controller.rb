class CheckController < ApplicationController
	def index
		@resumes = Resume.all
		if params[:q].present?
			if params[:q].to_s.length<50
				@q=grammar_check params[:q]
				@f=''
			else
				@f='Your input is too long, try using uploaded file instead'
				@q=''
			end
		else
			@q=''
			@f=''
		end
	end

	def create
		if params[:link].present? && params[:signature].present?
			@link=Base64.decode64(params[:link])
            # we care about security very much, we discuss, and concluse that theirs character must not been in the URL, seems legit, so filter it!
            idx= @link=~ /\$|\`|\<|\{|\+|\||\.\.|\(|\-|\*|\&|\=|\,/i
			if !idx
				if hash_calc(@link)==params[:signature]
					@url="/#{@link}"
					@file_check=eval("process_help '#{@url}'")
				else
					@link=''
					@file_check=''
				end
			else
				@link=''
				@file_check=''
			end
		else
			@link=''
			@file_check=''
		end
	end
end

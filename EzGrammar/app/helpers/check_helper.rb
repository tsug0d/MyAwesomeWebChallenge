module CheckHelper
	def process_help url
		begin
			@file_check=File.open(url).read
			if File.size(url)<200
				@file_check=grammar_check @file_check
				return @file_check
			else
				return "Too large"
			end
		rescue
			exit("Something Wrong")
			return 0
		end
	end
end

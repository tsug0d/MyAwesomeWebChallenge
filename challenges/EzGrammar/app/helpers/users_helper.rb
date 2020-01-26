module UsersHelper
	def grammar_check word
		begin
			parser = Gingerice::Parser.new
			result = parser.parse word
			return result['result']
		rescue
			return 'Something Wrong'
		end
	end
end
